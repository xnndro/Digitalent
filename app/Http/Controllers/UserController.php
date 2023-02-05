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

class UserController extends Controller
{
    public function index()
    {
        $options = array(
            'http' => array(
                'method'  => 'GET'
            )
        );
        
        $result = json_decode
        (file_get_contents
            ("https://sheetdb.io/api/v1/azny6h0q2lrka", false, stream_context_create($options))
        );

        $user = Auth::user()->name;
        $class = "";
        $gender ="";
        foreach($result as $row){
            if($row->Nama == $user){
                $class = $row->Kelas;
                $gender = $row->Gender;
            }
        }

        $user = Auth::user();
        $class = \App\Models\Classes::firstOrCreate(['namaKelas' => $class]);
        $user->class_id = $class->id;
        $user->gender = $gender;
        $user->save();

        // for widgets
        //laundry total
        $user_total_price = Laundry::where('user_id', Auth::user()->id)->sum('total_price');


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

        return view('user.pages.dashboard', compact('user_total_price', 'count_events','count_forums','forums'));
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
}
