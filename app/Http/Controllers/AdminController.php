<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Roommate;
use App\Models\Laundry;
use App\Models\Forum;
use App\Models\Order;

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

        $tanggalSekarang = date('Y-m-d');
        $laundry = Laundry::where('tanggalVendor',$tanggalSekarang)->get();
        $count_laundry = $laundry->count();

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
        
    
        return view('admin.pages.admin_dashboard',compact('count_request','total_price','count_laundry','femme','bclean','mills','count_forums','forums'));
    }
}
