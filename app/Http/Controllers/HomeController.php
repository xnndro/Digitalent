<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Storage;
use Illuminate\Support\Facades\Auth;
use App\Models\Classes;
use App\Models\Laundry;
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
            return redirect()->route('user.index');
        }else if($role == 'vendor'){
            return redirect()->route('laundry_vendor.dashboard');
        }
    }

}
