<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Classes;
use App\Models\Laundry;
use App\Models\User;
use App\Models\LaundryVendor;
use App\Models\Complain;

class ComplainController extends Controller
{
    public function index()
    {
        $complains = Complain::where('user_id',auth()->user()->id)->get();
        $complains_count = $complains->count();

        return view('user.pages.complain.index',compact('complains','complains_count'));
    }    
}
