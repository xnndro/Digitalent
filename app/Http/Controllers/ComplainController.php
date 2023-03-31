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
use App\Http\Controllers\WhatsappController;

class ComplainController extends Controller
{
    public function index()
    {
        $complains = Complain::where('user_id',Auth::user()->id)->get();
        $complains_count = $complains->count();
        // dd($complains);
        $complains = $complains->map(function($complain){
            $room = Room::where('id',$complain->user_room)->first();
            $complain->room_name = $room->name;
            return $complain;
        });

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
            })
            ->get();
        
        foreach($user_room as $room){
            if($room->status != 'accepted'){
                return redirect()->route('complains.index')->with('error_message',"You Don't Have Any Room Yet");
            }else
            {
                $user_class_id = Auth::user()->class_id;
                $classes = Classes::all();
                $class_name = Classes::where('id',$user_class_id)->first();
                $class_name = $class_name->namaKelas;
            }
            return view('user.pages.complain.create',compact('class_name','user_room'));
        }
    }
    public function laundry()
    {
        $laundry = Laundry::where('user_id',Auth::user()->id)->get();
        $laundry_count = $laundry->count();

        $user_room = Roommate::where(function($query) {
            $query->where('user_id', Auth::user()->id)
            ->orWhere('requested_user_id', Auth::user()->id);
            })
            ->get();

        if($user_room->count() == 0)
            return redirect()->route('complains.index')->with('error_message',"You Don't Have Any Room Yet");
        else{
            foreach($user_room as $room){
                if($room->status != 'accepted'){
                    return redirect()->route('complains.index')->with('error_message',"You Don't Have Any Room Yet");
                }else
                {
                    if($laundry_count == 0){
                        return redirect()->route('complains.index')->with('error_message',"You Don't Have Any Laundry Transaction");
                    }else
                    {
            
                        $laundries = Laundry::where('user_id',Auth::user()->id)
                        ->where('tanggalMaxComplain', '>=', Carbon::now()->format('Y-m-d'))
                        ->where('status','Done')->get();
                        
                        // dd($laundries);
                        return view('user.pages.complain.laundrycreate',compact('laundries'));
                    }
                }
            }
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
        $complain->user_room = $user_room->room_id;

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

            //send message
            $whatsapp = new WhatsappController;

            $vendor_name = LaundryVendor::where('id',$laundry->laundry_vendor_id)->first();
            $vendor_name = $vendor_name->name;

            $vendor_phone = User::where('name',$vendor_name)->first();
            $vendor_phone = $vendor_phone->phone;

            $transaction_name = Laundry::where('id',$request->transaction)->first();
            $transaction_name = $transaction_name->laundry_transaction_id;

            $user_phone = Auth::user()->phone;
            
            try{
                $data = [
                    'toNumber' => $vendor_phone,
                    'message' => 'Order Laundry dengan kode Laundry' . $transaction_name . 'memiliki complain, silahkan cek aplikasi'
                ];
    
                $whatsapp->sendMessage($data);
            }catch(\Exception $e){
                return redirect()->route('complains.index')->with('error_message',"Failed to send message");
            }

            try{
                $user_phone = Auth::user()->phone;
                $data = [
                    'toNumber' => $user_phone,
                    'message' => 'Komplain order Laundry dengan kode Laundry' . $transaction_name . 'telah berhasil tercomplain, silahkan cek aplikasi untuk updatenya'
                ];
                $whatsapp->sendMessage($data);
            }catch(Exception $e)
            {
                return redirect()->route('complains.index')->with('error_message',"Failed to send message");
            }
            
        }else if($request->type == 'Fasilitas'){
            //send message
            $whatsapp = new WhatsappController;
            $user_phone = Auth::user()->phone;

            try{

                $data = [
                    'toNumber' => $user_phone,
                    'message' => 'Komplain fasilitas dengan kode complain' . $complain->complain_id . 'telah berhasil tercomplain, silahkan cek aplikasi untuk updatenya'
                ];
                $whatsapp->sendMessage($data);
            }catch(Exception $e)
            {
                return redirect()->route('complains.index')->with('error_message',"Failed to send message");
            }

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
                // dd($complain->user_room);
            });
            $count= $complains->count();
            
            return view('admin.pages.complains.index',compact('complains','count'));
        }
        else if($user == 'vendor')
        {
            $complains = Complain::where('complain_type','Laundry')
            ->where('status','!=','done')
            ->get();

            // get vendor id by check the laundry vendor table, if the name is same, take the id
            $vendor_id = LaundryVendor::where('name',Auth::user()->name)->first();
            if($vendor_id == 'Femme'){
                $complains = Complain::where('complain_type','Laundry')
                ->where('status','!=','done')
                ->where('laundry_vendor_id','1')
                ->get();
                
            }else if($vendor_id == 'Bclean'){
                $complains = Complain::where('complain_type','Laundry')
                ->where('status','!=','done')
                ->where('laundry_vendor_id','2')
                ->get();
            }else if($vendor_id == 'Mills'){
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
            $count= $complains->count();
            return view('adminVendor.pages.complain.index',compact('complains','count'));
        }
    }

    public function adminProceed($id)
    {
        $complain = Complain::where('id',$id)->first();
        $complain->status = 'proceed';
        $complain->save();

        //send message
        $user_phone = User::where('id',$complain->user_id)->first();
        $user_phone = $user_phone->phone;
        $whatsapp = new WhatsappController;

        try{

            $data = [
                'toNumber' => $user_phone,
                'message' => 'Komplain kamu dengan kode complain '. $complain->complain_id . ' sedang diproses, silahkan cek aplikasi untuk updatenya'
            ];
            $whatsapp->sendMessage($data);
        }catch(Exception $e)
        {
         
        }
        return redirect()->route('complains.show')->with('success_message','Complain has been proceed');
    }

    public function adminFinish($id)
    {
        $complain = Complain::where('id',$id)->first();
        $complain->status = 'done';
        $complain->save();

        $user_phone = User::where('id',$complain->user_id)->first();
        $user_phone = $user_phone->phone;
        $whatsapp = new WhatsappController;

        try{

            $data = [
                'toNumber' => $user_phone,
                'message' => 'Komplain kamu dengan kode complain '. $complain->complain_id . ' telah selesai diproses, Mohon maaf untuk ketidaknyamanannya'
            ];
            $whatsapp->sendMessage($data);
        }catch(Exception $e)
        {
         
        }
        return redirect()->route('complains.show')->with('success_message','Complain has been done');
    }
}
