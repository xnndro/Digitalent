<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\OrderDetails;
use Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HistoryController extends Controller
{
    public function index(){
        $histories = Order::where('name', Auth::user()->name)->where('payment_status', 2)->get();
        $histories_details = [];

        foreach($histories as $history){
            $history_detail = DB::table('order_details')
                                    ->join('products', 'order_details.product_id', '=', 'products.id')
                                    ->where('order_details.order_transaction_id', $history->order_transaction_id)
                                    ->get();
            
            array_push($histories_details, $history_detail);
        }

        return view('user.pages.shopping.history', ['histories' => $histories, 'histories_details' => $histories_details]);
    }

    public function delHistory($id){
        $orders = Order::where('order_transaction_id', $id);
        $order_details = OrderDetails::where('order_transaction_id', $id);
        $orders->delete();
        $order_details->delete();
        return redirect()->route('history');
    }

    public function renameHistory(Request $request, $id){
        Order::where('order_transaction_id', $id)
                ->update(['invoice_name' => $request->get('new_name')]);
        return redirect()->route('history');
    }

}
