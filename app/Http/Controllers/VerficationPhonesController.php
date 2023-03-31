<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VerifiedPhones;
use Illuminate\Support\Facades\Auth;
use Alert;

class VerficationPhonesController extends Controller
{
    public function index()
    {
        $user_phone = Auth::user()->phone;
        if(session('success'))
            Alert::success('Success', session('success_message'));
        else if(session('error'))
            Alert::error('Error', session('error_message'));
        return view('user.pages.verification.index', compact('user_phone'));
    }

    //function for compare code from user and code from database
    public function store(Request $request)
    {
        // dd("sampe sini");
        $request->validate([
            'code' => 'required',
        ]);

        $code = $request->code;
        $user_id = Auth::user()->id;
        $data = VerifiedPhones::where('user_id', $user_id)->first();

        if ($data->code == $code) {
            $data->delete();
            return redirect()->route('dashboard');
        } else {
            return redirect()->back()->with('error', 'Code is not valid');
        }
    }

    public function resend()
    {
        $user_id = Auth::user()->id;
        $data = VerifiedPhones::where('user_id', $user_id)->first();
        $data->code = rand(1000, 9999);
        $data->save();
        return redirect()->back()->with('success', 'Code has been sent');
    }

    public function inputnewphone()
    {
        return view('user.pages.verification.newnumber');
    }

    public function storenewphone(Request $request)
    {
        $request->validate([
            'phone' => 'required',
        ]);

        $user_id = Auth::user()->id;
        $data = VerifiedPhones::where('user_id', $user_id)->first();
        $data->phone = $request->phone;
        $data->code = rand(1000, 9999);
        $data->status = 'pending';
        $data->save();
        return redirect()->route('verification.index')->with('success', 'Phone number has been changed');
    }
}
