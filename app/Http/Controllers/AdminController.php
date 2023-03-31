<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Roommate;
use App\Models\Laundry;
use App\Models\Forum;
use App\Models\Order;
use App\Models\Financial;
use Illuminate\Support\Facades\Auth;
use App\Models\Complain;

class AdminController extends Controller
{
    public function index()
    {
        $count_request = Roommate::where('status','=','pending')->get();
        $count_request = $count_request->count();

        $bulanIni = date('m');
        $count_price = Laundry::where('status','=','Done')
        ->whereMonth('tanggalAmbil', $bulanIni)
        ->get();
        $count_order = Order::where('payment_status','=','2')
        ->whereMonth('created_at', $bulanIni)
        ->get();

        $total_price = 0;
        foreach($count_price as $c)
        {
            $total_price += $c->total_price;
        }

        foreach($count_order as $c)
        {
            $total_price += $c->total_price;
        }

        $complains_total = Complain::where('status','=','pending')
        ->where('complain_type','=','Fasilitas')
        ->get();
        $complains_total = $complains_total->count();
        $femme = Laundry::where('laundry_vendor_id','1')->get();
        $femme = $femme->count();
        $bclean = Laundry::where('laundry_vendor_id','2')->get();
        $bclean = $bclean->count();
        $mills = Laundry::where('laundry_vendor_id','3')->get();
        $mills = $mills->count();

        // forum
        $forums = Forum::all();
        //get new post by order by created_at
        $forums = $forums->sortByDesc('likes');
        $count_forums = $forums->count();
        $forums = $forums->take(3);

        $ordertotake = Order::where('order_status','=','paid')->get();
        $order_totals = $ordertotake->count();
        
    
        return view('admin.pages.admin_dashboard',compact('count_request','total_price','complains_total','femme','bclean','mills','count_forums','forums','order_totals'));
    }

    public function financials()
    {
        // financial history
        $financials = Financial::where('user_id',Auth::user()->id)->get();
        $count = $financials->count();
        return view('admin.pages.financials',compact('financials','count'));
    }
}
