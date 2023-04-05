<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Cart;
use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\Product;
use Darryldecode\Cart\CartCondition;
use App\Services\Midtrans\CreateSnapTokenService;
use Alert;
use Midtrans\Config;

class CartController extends Controller
{
    public function incQty($rowId){
        // get product stock
        $product = Cart::get($rowId);
        $limitstock =(int) $product->qty+1;
        $stock = Product::where('name','=',$product->name)->first();
        $stock = $stock->stock;
        if($stock < $limitstock)
        {
            return redirect()->route('cart')->with('error','Cannot Update Qty because the stock is '. $stock);
        }else
        {
            $qty = $product->qty + 1;
            Cart::update($rowId, $qty);
            Cart::store(Auth::user()->name);
            return redirect()->route('cart');
        }
    }

    public function decQty($rowId){
        $product = Cart::get($rowId);
        $qty = $product->qty - 1;
        Cart::update($rowId, $qty);
        Cart::store(Auth::user()->name);
        return redirect()->route('cart');
    }

    public function changeQty($rowId, $qty){
        $product = Cart::get($rowId);
        Cart::update($rowId, $qty);
        Cart::store(Auth::user()->name);
        return redirect()->route('cart');
    }

    public function delItem($rowId){
        Cart::remove($rowId);
        Cart::store(Auth::user()->name);
        return redirect()->route('cart');
    }

    public function index(){
        return view('user.pages.shopping.cart');
    }

    public function checkout(){
        $user = User::find(Auth::user()->id);
        $number = rand(10000000, 99999999);
        $order_transaction_id = $number;
        $total_price = (int)Cart::total(0, "", "") - (int)Cart::tax(0, "", "");

        if($total_price == 0){
            return view('user.pages.shopping.cart');
        }

        // $expired = date('Y-m-d H:i:s', strtotime('+1 day', strtotime(date('Y-m-d H:i:s'))));
        // make expired 1 minutes
        $expired = date('Y-m-d H:i:s', strtotime('+2 minutes', strtotime(date('Y-m-d H:i:s'))));
        $order = Order::create([
            'name' => $user->name,
            'order_transaction_id' => $order_transaction_id,
            'invoice_name' => $order_transaction_id,
            'user_id' => $user->id,
            'number' => $number,
            'total_price' => $total_price,
            'payment_status' => 1,
            'order_status' => 'pending',
            'expired_time' => $expired,
        ]);

        // dd($order);

        foreach(Cart::content() as $item){
            //get product
            $products = Product::find($item->id);
            //get product stock
            $stock = $products->stock;
            //get product qty
            $qty = $item->qty;
            $stock = $stock - $qty;
            //update product stock
            $products->update([
                'stock' => $stock,
            ]); 
            
            // create order details
            OrderDetails::create([
                'order_transaction_id' => $order_transaction_id,
                'product_id' => $item->id,
                'qty' => $qty,
            ]);
        }

        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = $_ENV['MIDTRANS_SERVER_KEY'];
        $clientKey = $_ENV['MIDTRANS_CLIENT_KEY'];
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = false;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;

        $name = $user->name;

        $params = array(
            'transaction_details' => array(
                'order_id' => $number,
                'gross_amount' => $total_price,
            ), 'customer_details' => array(
                'name' => $name,
            )
        );

        $redirectUrl = array(
            'finish_redirect_url' => route('dashboard'),
            'unfinish_redirect_url' => route('dashboard'),
        );

        $snapToken = \Midtrans\Snap::getSnapToken($params, $redirectUrl);
        // dd($snapToken);

        Cart::destroy();
        Cart::store(Auth::user()->name);
        
        // return redirect()->route('orders',['order' => $order]);
        Cart::destroy();
        Cart::store(Auth::user()->name);

        return view('user.pages.shopping.checkout', compact('snapToken', 'order'));
    }

    public function toPay($id){
        // $order = Order::all();
        // foreach($order as $item){
        //     if($item->id == $id){
        //         $order = $item;
        //     }
        // }
        $order = Order::find($id);
        // dd($order, $id);
        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = $_ENV['MIDTRANS_SERVER_KEY'];
        $clientKey = $_ENV['MIDTRANS_CLIENT_KEY'];
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = false;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;

        $name = $order->name;
        $total_price = $order->total_price;

        $params = array(
            'transaction_details' => array(
                'order_id' => $order->number,
                'gross_amount' => $total_price,
            ), 'customer_details' => array(
                'name' => $name,
            )
        );

        $redirectUrl = array(
            'finish_redirect_url' => route('dashboard'),
            'unfinish_redirect_url' => route('dashboard'),
        );

        $snapToken = \Midtrans\Snap::getSnapToken($params, $redirectUrl);
        // dd($snapToken);
        
        // return redirect()->route('orders',['order' => $order]);
        return view('user.pages.shopping.checkout', compact('snapToken', 'order'));
    }

    public function callback(Request $request){
        $server_key = $_ENV['MIDTRANS_SERVER_KEY'];
        $hash = hash('sha512', $request->order_id . $request->status_code . $request->gross_amount . $server_key);
        // if($hash == $request->signature_key){
            if($request->transaction_status == 'capture'){
                if($request->status_code == '200'){
                    $order = Order::where('number', $request->order_id)->first();
                    $order->update([
                        'payment_status' => 2,
                        'order_status' => 'paid'
                    ]);

                    $user_phone = Auth::user()->phone;
                    $name = Auth::user()->name;
                    $order = Order::where('number', $request->order_id)->first();
                    $order_transaction_id = $order->order_transaction_id;
            
                    try{
                        $data =[
                            'toNumber' => $user_phone,
                            'message' => 'Halo '.$name.', Terimakasih telah berbelanja di Kios Talenta, silahkan mengambil barang anda di Kios Talenta dalam 5 menit dengan nomer invoice '. $order_transaction_id .'Terimakasih.',
                            ] ;
                            
                            $whatsapp = new WhatsappController;
                            $whatsapp->sendMessage($data);
                    }catch(\Exception $e){
                        
                    }
                    $role = Auth::user()->role;
                    return redirect()->route('dashboard');
                }
            }elseif($request->transaction_status == 'cancel')
            {
                $order = Order::where('number', $request->order_id)->first();
                $order->update([
                    'payment_status' => 4,
                    'order_status' => 'canceled'
                ]);
                return redirect()->route('dashboard');
            }
        // }
        // return view('user.pages.shopping.cart');
    }

    public function toTake()
    {
        $order = Order::where('order_status', 'paid')->get();
        $count = $order->count();

        //mapping order details
        foreach($order as $item){
            $order_details = OrderDetails::where('order_transaction_id', $item->order_transaction_id)->get();
            $item->order_details = $order_details;

            //mapping product
            foreach($order_details as $item2){
                $product = Product::find($item2->product_id);
                $item2->product = $product;
            }
        }
        return view('admin.pages.shopping.take', compact('order','count'));
    }

    public function toTakeOrder($id)
    {
        $order = Order::find($id);
        $order->update([
            'order_status' => 'taken',
        ]);
        return redirect()->route('toTake');
    }

    public function cancelOrder($id)
    {
        $order = Order::find($id);

        // midtrans cancel order
        \Midtrans\Config::$serverKey = $_ENV['MIDTRANS_SERVER_KEY'];
        \Midtrans\Config::$isProduction = false;
        \Midtrans\Config::$isSanitized = true;
        \Midtrans\Config::$is3ds = true;

        $orderId = $order->number;
        // dd($orderId);
        $cancel = \Midtrans\Transaction::cancel($orderId);
        // dd($cancel);

        $order->update([
            'order_status' => 'canceled',
        ]);

        return redirect()->route('dashboard');
    }
}
