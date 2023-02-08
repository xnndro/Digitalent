<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Classes;
use App\Models\Laundry;
use App\Models\User;
use App\Models\LaundryVendor;
use App\Models\Complain;
use App\Models\Roommate;
use Illuminate\Support\Facades\Auth;
use Alert;
use Carbon\Carbon;

class ComplainController extends Controller
{
    public function index()
    {
        $complains = Complain::where('user_id',auth()->user()->id)->get();
        $complains_count = $complains->count();

        if(session('success_message')){
            Alert::success('Success', session('success_message'));
        }
        return view('user.pages.complain.index',compact('complains','complains_count'));
    }    

    public function create()
    {
        $user_class_id = Auth::user()->class_id;
        $classes = Classes::all();
        $class_name = Classes::where('id',$user_class_id)->first();
        $class_name = $class_name->namaKelas;

        $user_room = Roommate::where(function($query) {
            $query->where('user_id', Auth::user()->id)
            ->orWhere('requested_user_id', Auth::user()->id);
            })->first();
        
        // dd($user_room);

        return view('user.pages.complain.create',compact('class_name','user_room'));
    }
    public function laundry()
    {
        $laundries = Laundry::where('user_id',Auth::user()->id)
        ->whereBetween('created_at', [Carbon::now()->subWeek()->startOfWeek(), Carbon::now()->endOfWeek()])
        ->where('status','=','Done')->get();

        // dd($laundries);

        return view('user.pages.complain.laundrycreate',compact('laundries'));
    }

    public function store(Request $request)
    {
        //check complain type dengan get request type

        $complain = new Complain;
        //make id
        $complain->user_id = Auth::user()->id;
        $complain->complain_id = 'C-'.date('YmdHis');
        $complain->complain_type = $request->type;
        $complain->complain_name = $request->name;
        $complain->description = $request->description;

        if($request->type == 'Laundry'){
            if($request->hasFile('fotoBarang')){
                $destination_path = 'public/uploads/complain/';
                $file = $request->file('fotoBarang');
                $name = $file->getClientOriginalName();
                $path = $request->file('fotoBarang')->storeAs($destination_path, $name);
                $complain->fotoBarang = $name;
            }
            
            $complain->transaction_id = $request->transaction;
            $complain->jumlahBarang = $request->jumlahBarang;
        }

        $complain->save();

        return redirect()->route('complains.index')->with('success_message','Complain has been sent');
    }
}
