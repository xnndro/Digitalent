<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Storage;
use Illuminate\Support\Facades\Auth;
use App\Models\Classes;
use App\Models\Laundry;
use App\Models\User;
// user
use App\Models\LaundryVendor;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $role = auth()->user()->role;
        if ($role == 'admin') {
            return redirect()->route('admin.index');
        } else if ($role == 'user') {
            // cek si user uda isi form atau belom, kalo misal belom, direct ke form, kalo uda direct ke dashboard
            $user_id = Auth::user()->id;
            $user = User::where('id', $user_id)->first();
            if ($user->form_status == null) {
                return redirect()->route('roommates.create');
            } else {
                return redirect()->route('user.index');
            }

            // return redirect()->route('user.index');
        }else if($role == 'vendor'){
            return redirect()->route('laundry_vendor.dashboard');
        }
    }
}
