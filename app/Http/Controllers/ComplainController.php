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
use Illuminate\Support\Facades\DB;
use App\Models\Room;

class ComplainController extends Controller
{
    public function index()
    {
        $complains = Complain::where('user_id',auth()->user()->id)->get();
        $complains_count = $complains->count();

        if(session('success_message')){
            Alert::success('Success', session('success_message'));
        }else if(session('error_message'))
        {
            Alert::error('Error', session('error_message'));
        }
        return view('user.pages.complain.index',compact('complains','complains_count'));
    }    

    public function create()
    {
        $user_room = Roommate::where(function($query) {
            $query->where('user_id', Auth::user()->id)
            ->orWhere('requested_user_id', Auth::user()->id);
            })->first();
        
        if($user_room == null){
            return redirect()->route('complains.index')->with('error_message','You have no roommate and room');
        }else
        {
            $user_class_id = Auth::user()->class_id;
            $classes = Classes::all();
            $class_name = Classes::where('id',$user_class_id)->first();
            $class_name = $class_name->namaKelas;
        }
        return view('user.pages.complain.create',compact('class_name','user_room'));
    }
    public function laundry()
    {
        $laundry = Laundry::where('user_id',Auth::user()->id)->get();
        $laundry_count = $laundry->count();

        if($laundry_count == 0){
            return redirect()->route('complains.index')->with('error_message','You have no laundry transaction');
        }else
        {

            $laundries = Laundry::where('user_id',Auth::user()->id)
            ->whereBetween('created_at', [Carbon::now()->subWeek()->startOfWeek(), Carbon::now()->endOfWeek()])
            ->where('status','=','Done')->get();
            
            return view('user.pages.complain.laundrycreate',compact('laundries'));
        }
    }

    public function store(Request $request)
    {
        //check complain type dengan get request type
        $user_room = Roommate::where(function($query) {
            $query->where('user_id', Auth::user()->id)
            ->orWhere('requested_user_id', Auth::user()->id);
            })->first();
        
            // dd($user_room);
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

            //get laundry vendor id from laundry transaction
            $laundry = Laundry::where('id',$request->transaction)->first();
            $complain->laundry_vendor_id = $laundry->laundry_vendor_id;

        }else if($request->type == 'Fasilitas'){
            $complain->user_room = $user_room->room_id;
        }

        $complain->save();
        return redirect()->route('complains.index')->with('success_message','Complain has been sent');
    }


    public function show()
    {
        if(session('success_message')){
            Alert::success('Success', session('success_message'));
        }
        $user = Auth::user()->role;
        
        if($user == 'admin')
        {
            $complains = Complain::where('complain_type','Fasilitas')
            ->where('status','!=','done')
            ->get();

            //get room name from room id with user_room on this table
            $complains = $complains->map(function($complain){
                $room = Room::where('id',$complain->user_room)->first();
                $complain->room_name = $room->name;
                return $complain;
            });
            $count= $complains->count();
            return view('admin.pages.complains.index',compact('complains','count'));
        }
        else
        {

            $complains = Complain::where('complain_type','Laundry')
            ->where('status','!=','done')
            ->get();

            // get vendor id by check the laundry vendor table, if the name is same, take the id
            $vendor_id = LaundryVendor::where('name',Auth::user()->name)->first();
            if($vendor_id == '1'){
                $complains = Complain::where('complain_type','Laundry')
                ->where('status','!=','done')
                ->where('laundry_vendor_id','1')
                ->get();
                
            }else if($vendor_id == '2'){
                $complains = Complain::where('complain_type','Laundry')
                ->where('status','!=','done')
                ->where('laundry_vendor_id','2')
                ->get();
            }else if($vendor_id == '3'){
                $complains = Complain::where('complain_type','Laundry')
                ->where('status','!=','done')
                ->where('laundry_vendor_id','3')
                ->get();
            }
            $complains = $complains->map(function($complain){
                $laundry = Laundry::where('id',$complain->transaction_id)->first();
                $complain->noTransaksi = $laundry->laundry_transaction_id;
                return $complain;
            });
            // dd($complains->transaction_id);
            $count= $complains->count();
            return view('adminVendor.pages.complain.index',compact('complains','count'));
        }
    }

    public function adminProceed($id)
    {
        $complain = Complain::where('id',$id)->first();
        $complain->status = 'proceed';
        $complain->save();
        return redirect()->route('complains.show')->with('success_message','Complain has been proceed');
    }

    public function adminFinish($id)
    {
        $complain = Complain::where('id',$id)->first();
        $complain->status = 'done';
        $complain->save();
        return redirect()->route('complains.show')->with('success_message','Complain has been done');
    }
}
