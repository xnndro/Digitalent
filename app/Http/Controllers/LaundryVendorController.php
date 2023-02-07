<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Laundry;
use App\Models\LaundryType;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Alert;


class LaundryVendorController extends Controller
{
    public function dashboard()
    {
        $username = auth()->user()->name;
        $tanggalSekarang = date('Y-m-d');
        $tanggalSekarang = (string)$tanggalSekarang;
        

        $id = '';
        if($username == 'Femme')
        {
            $id = '1';
        }else if($username == 'Bclean')
        {
            $id = '2';
        }else if($username == 'Mills')
        {
            $id = '3';
        }


        $laundry = Laundry::where('laundry_vendor_id',$id)->get();
        $order_today = 0;
        $total_price = 0;

        foreach($laundry as $l)
        {
            if($l->tanggalVendor == $tanggalSekarang)
            {
                $order_today = $order_today+1;
                $total_price += $l->total_price;
            }
        }

        // for conclusion
        $total_order = 0;
        $total_revenue = 0;
        foreach($laundry as $l)
        {
            if($l->status=='Done' || $l->status=='Delivered')
            {
                $total_order += 1;
                $total_revenue += $l->total_price;
            }
        }

        $count_user = Laundry::where('laundry_vendor_id',$id)->distinct('user_id')->count('user_id');

        $reference_dates = ['Monday', 'Wednesday', 'Friday'];
        $current_day = date('l'); 
        
        
        $nearest_inputted_date = Laundry::where('laundry_vendor_id', $id)
                                        ->where('status', 'Inputed')
                                        ->whereIn(DB::raw("DATE_FORMAT(tanggalVendor, '%W')"), $reference_dates)
                                        ->orderBy('tanggalVendor', 'asc')
                                        ->first();

        if (!in_array($current_day, $reference_dates)) {
            $reference_date = date('Y-m-d', strtotime('next Monday'));
        } else {
            $reference_date = date('Y-m-d');
        }

        if ($nearest_inputted_date && $nearest_inputted_date->tanggalVendor < $reference_date) {
            $reference_date = $nearest_inputted_date->tanggalVendor;
        }

        $orders = Laundry::where('laundry_vendor_id', $id)
                  ->whereDate('tanggalVendor', $reference_date)
                  ->where('status', 'Inputed')
                  ->get();
        $total_incoming_order = $orders->count();
        $total_incoming_revenue = $orders->sum('total_price');

        if(session('success_message'))
        {
            Alert::success('Success', session('success_message'));
        }
        
        return view('adminVendor.pages.dashboard', compact('username', 'order_today', 'total_price', 'total_order', 'total_revenue', 'count_user', 'total_incoming_order', 'total_incoming_revenue', 'nearest_inputted_date'));
    }

    public function index()
    {
        $username = auth()->user()->name;
        $id = '';
        if($username == 'Femme')
        {
            $id = '1';
        }else if($username == 'Bclean')
        {
            $id = '2';
        }else if($username == 'Mills')
        {
            $id = '3';
        }

        $laundry = Laundry::where('laundry_vendor_id', $id)
                   ->where('status', 'Taked')
                   ->get();
        $count = $laundry->count();

        if(session('success_message'))
        {
            Alert::success('Success', session('success_message'));
        }
        return view('adminVendor.pages.transaction', compact('laundry', 'count'));
    }

    public function transactionforadmin()
    {
        $username = auth()->user()->name;
        $id = '';
        if($username == 'Femme')
        {
            $id = '1';
        }else if($username == 'Bclean')
        {
            $id = '2';
        }else if($username == 'Mills')
        {
            $id = '3';
        }

        $laundry = Laundry::where('laundry_vendor_id', $id)
                   ->where('status', 'Procesed')
                   ->get();
        $count = $laundry->count();

        if(session('success_message'))
        {
            Alert::success('Success', session('success_message'));
        }
        return view('adminVendor.pages.transactionforadmin', compact('laundry', 'count'));
    }

    public function edit($id)
    {
        $laundry = Laundry::find($id);
        return view('adminVendor.pages.edit', compact('laundry'));
    }

    public function update(Request $request, $id)
    {
        $laundry = Laundry::find($id);
        $laundry->total_pcs = $request->get('total_pcs');
        $laundry->save();
        $laundry->update($request->all());

        return redirect()->route('laundry_vendor.index')->withSuccessMessage('Data berhasil diubah');
    }

    public function history()
    {
        $username = auth()->user()->name;
    
        $id = '';
        if($username == 'Femme')
        {
            $id = '1';
        }else if($username == 'Bclean')
        {
            $id = '2';
        }else if($username == 'Mills')
        {
            $id = '3';
        }

        $laundry = Laundry::where('laundry_vendor_id', $id)
                   ->whereIn('status', ['Done', 'Delivered'])
                   ->get();

        $total = 0;
        foreach ($laundry as $l) {
            $total += $l->total_price;
        }

        $count = $laundry->count();

        return view('adminVendor.pages.history', compact('laundry', 'count','total'));
    }

    public function process($id)
    {
        $laundry = Laundry::find($id);
        $laundry->status = 'Procesed';
        $laundry->save();
        return redirect()->route('laundry_vendor.index')->withSuccessMessage('Laundry has been processed');
    }

    public function done($id)
    {
        $laundry = Laundry::find($id);
        $laundry->status = 'Delivered';
        $laundry->save();
        return redirect()->route('laundry_vendor.transactionforadmin')->withSuccessMessage('Laundry has been delivered');
    }
}
