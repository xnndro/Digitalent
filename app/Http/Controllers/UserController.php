<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Storage;
use Illuminate\Support\Facades\Auth;
use App\Models\Classes;
use App\Models\Laundry;
use App\Models\LaundryVendor;
use App\Models\User;
use App\Models\Events;
use App\Models\Forum;
use App\Models\ShoppingCart;
use Cart;
use Alert;
use App\Models\Order;
use App\Models\Financial;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;



class UserController extends Controller
{
    public function index()
    {
        $options = array(
            'http' => array(
                'method'  => 'GET'
            )
        );
        
        // $result = json_decode
        // (file_get_contents
        //     ("https://sheetdb.io/api/v1/azny6h0q2lrka", false, stream_context_create($options))
        // );

        $user = Auth::user()->name;
        $class = "";
        $gender ="";
        // foreach($result as $row){
        //     if($row->Nama == $user){
        //         $class = $row->Kelas;
        //         $gender = $row->Gender;
        //     }
        // }

        $user = Auth::user();
        $class = \App\Models\Classes::firstOrCreate(['namaKelas' => $class]);
        $user->class_id = $class->id;
        $user->gender = $gender;
        $user->save();

        // for widgets
        //laundry total
        $user_total_price = Laundry::where('user_id', Auth::user()->id)
        ->whereMonth('created_at', date('m'))
        ->sum('total_price');


        //for upcoming events remainder
        $events = Events::where('status', 'notified')->get();
        $count_events = $events->count();

        //for forum new post
        $forums = Forum::all();
        //get new post by order by created_at
        $forums = $forums->sortByDesc('created_at');
        $forums = $forums->take(2);
        $count_forums = $forums->count();
        // $count_forums = 0;

        if(session('success_message')){
            Alert::success('Success', session('success_message'));
        }

        $shoppingcart = ShoppingCart::all();
        $shoppingcart_name = '';
        foreach ($shoppingcart as $s){
            $shoppingcart_name = $s->identifier;
            if($shoppingcart_name == Auth::user()->name){
                Cart::restore(Auth::user()->name);
            }
        }

        // get all data order where status is 1 and user_id is auth user id
        $orders = Order::where('payment_status','1')
        ->where('user_id',Auth::user()->id)
        ->get();

        $orders_count = $orders->count();


        $orders_done= Order::where('payment_status','2')
        ->whereMonth('created_at', date('m'))
        ->where('user_id',Auth::user()->id)
        ->get();

        $orders_done_count = $orders_done->count();
        $orders_done = $orders_done->take(4);

        // for widgets shopping
        $total_shopping = $orders_done->sum('total_price');
        $total_transaction = $total_shopping + $user_total_price;
        return view('user.pages.dashboard', compact('user_total_price', 'count_events','count_forums','forums','orders','orders_count','orders_done','orders_done_count','total_transaction','total_shopping'));
    }

    public function laundry_status()
    {
        $laundry = Laundry::join('laundry_vendors', 'laundry_vendors.id', '=', 'laundries.laundry_vendor_id')
            ->select('laundries.*', 'laundry_vendors.name as vendor_name')
            ->where('laundries.user_id', Auth::user()->id)
            ->get();
        $count = Laundry::where('user_id', Auth::user()->id)->count();
        // $count= 0;
        // count total_price of laundry where transaction is user_id

        return view('user.pages.laundry_status', compact('laundry', 'count'));
    }

    public function financial_index()
    {
        $user_id = Auth::user()->id;
        $shopping_this_month = Order::where('user_id', $user_id)
        ->whereMonth('created_at', date('m'))
        ->where('payment_status', '2')
        ->get();

        $shopping_last_month = Order::where('user_id', $user_id)
        ->whereMonth('created_at', date('m')-1)
        ->where('payment_status', '2')
        ->get();

        $laundry_this_month = Laundry::where('user_id', $user_id)
        ->whereMonth('created_at', date('m'))
        ->where('status', 'Done')
        ->get();

        $laundry_last_month = Laundry::where('user_id', $user_id)
        ->whereMonth('created_at', date('m')-1)
        ->where('status', 'Done')
        ->get();

        $shopping_this_month_total = $shopping_this_month->sum('total_price');
        $shopping_last_month_total = $shopping_last_month->sum('total_price');
        $laundry_this_month_total = $laundry_this_month->sum('total_price');
        $laundry_last_month_total = $laundry_last_month->sum('total_price');

        $total_transaction = Order::where('user_id', $user_id)
        ->where('payment_status', '2')
        ->sum('total_price');

        $total_data_transaction = Order::where('user_id', $user_id)
        ->where('payment_status', '2')
        ->count();


        if($shopping_last_month_total == 0){
            $shopping_percentage = 0;
            $status = 0;
        }else{
            $shopping_percentage = ($shopping_this_month_total - $shopping_last_month_total) / $shopping_last_month_total * 100;
            $status = 1;
        }
        
        if($laundry_last_month_total == 0){
            $laundry_percentage = 0;
            $status_laundry = 0;
        }else{
            $laundry_percentage = ($laundry_this_month_total - $laundry_last_month_total) / $laundry_last_month_total * 100;
            $status_laundry = 1;
        }

        if($shopping_this_month_total == 0 && $shopping_last_month_total == 0 && $laundry_this_month_total == 0 && $laundry_last_month_total == 0){
            $status = 2;
        }

        $financial = Financial::where('user_id', $user_id)->get();
        $name= '';
        foreach($financial as $f)
        {
            $name = $f->name;
            $bulan = date('F',strtotime($name));
            $f->name = $bulan;
        }

        $financial_count = $financial->count();

        return view('user.pages.financial.index', compact('shopping_this_month', 'shopping_last_month', 'laundry_this_month', 'laundry_last_month', 'shopping_this_month_total', 'shopping_last_month_total', 'laundry_this_month_total', 'laundry_last_month_total', 'shopping_percentage', 'laundry_percentage', 'status', 'status_laundry', 'total_transaction', 'total_data_transaction','financial','financial_count'));
    }

    public function financial_show($id)
    {
        $financial = Financial::find($id);
        $name = $financial->name;
        $user_id = $financial->user_id;
        //get transaction name by transaction_id 
        $laundry_on_the_month = Laundry::where('user_id',$user_id)
        ->whereMonth('created_at',$name)
        ->orderBy('created_at','desc')
        ->get();

        $total_laundry = $laundry_on_the_month->sum('total_price');
        $total_laundry_transaction = $laundry_on_the_month->count();

        $shopping_on_the_month = Order::where('user_id',$user_id)
        ->whereMonth('created_at',$name)
        ->orderBy('created_at','desc')
        ->get();

        $total_shopping = $shopping_on_the_month->sum('total_price');
        $total_shopping_transaction = $shopping_on_the_month->count();

        $total_transaction = $total_laundry+$total_shopping;
        $total_data_transaction = $total_laundry_transaction + $total_shopping_transaction;

        $name = date('F',strtotime($name));

        
        return view('user.pages.financial.show', compact('financial',
         'name','laundry_on_the_month','total_laundry','total_laundry_transaction',
         'shopping_on_the_month','total_shopping','total_shopping_transaction',
         'total_transaction','total_data_transaction'));
    }
}
