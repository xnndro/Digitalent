<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Cart;
use App\Models\Order;
// products
use App\Models\Product;
use Darryldecode\Cart\CartCondition;
use App\Services\Midtrans\CreateSnapTokenService;
use Alert;
use Midtrans\Config;



class CartController extends Controller
{
    public function incQty($rowId){
        $product = Cart::get($rowId);
        $qty = $product->qty + 1;
        Cart::update($rowId, $qty);
        Cart::store(Auth::user()->name);
        return redirect()->route('cart');
    }

    public function decQty($rowId){
        $product = Cart::get($rowId);
        $qty = $product->qty - 1;
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
        $transaction_id_order = 'INV-'.$number;

        $order = Order::create([
            'name' => $user->name,
            'order_transaction_id' => $transaction_id_order,
            'user_id' => $user->id,
            'number' => $number,
            'total_price' => floatval(Cart::total()),
            'payment_status' => 1,
        ]);
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
                'gross_amount' => floatval(Cart::total()),
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

    public function toPay($id){
        // $order = Order::all();
        // foreach($order as $item){
        //     if($item->id == $id){
        //         $order = $item;
        //     }
        // }
        $order = Order::find($id);
        // dd($order);
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
        if($hash == $request->signature_key){
           if($request->transaction_status == 'capture'){
               if($request->status_code == '200'){
                   $order = Order::where('number', $request->order_id)->first();
                   $order->update([
                       'payment_status' => 2,
                   ]);
                   Cart::destroy();
                //    Cart::store($user()->name);
               }
           }
        }
    }
}
