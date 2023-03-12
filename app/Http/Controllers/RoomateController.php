<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Roommate;
use Illuminate\Support\Facades\Auth;
use SheetDB\SheetDB;
use GuzzleHttp\Client;
use App\Models\Classes;
use App\Models\User;
use App\Models\Room;
use App\Http\Controllers\WhatsAppController;
use Alert;
use App\Models\UserRequest;


class RoomateController extends Controller
{
    public function index()
    {   
        if(session('success_message'))
        {
            Alert::success('Success', session('success_message'));
        }

        $user_class_id = Auth::user()->class_id;
        $user_class = Classes::find($user_class_id);
        $jumlah_siswa = $user_class->jumlahSiswa;

        
        $users_roommates = User::where('class_id', $user_class_id)->where('roommate_status', 1)->get();
        $count_roomates = $users_roommates->count();

        // split the name of class, take the name without the number
        $class_name = explode(' ', $user_class->namaKelas);

        $user_status = '';
        if($jumlah_siswa-1 == $count_roomates){
            if($class_name[0] == 'PPTI')
            {
                if($jumlah_siswa == 35)
                {
                    $user_status = 'single';
                }else
                {
                    $user_status = 'wait';
                }
            }else if($class_name[0] == 'PPBP')
            {
                if($jumlah_siswa == 45)
                {
                    $user_status = 'single';
                }else
                {
                    $user_status = 'wait';
                }
            }   
        }

        if($user_status == 'single')
        {
            $status = 'single';

            return view('user.pages.roomates.index',compact('status'));
        }else if($user_status == 'wait')
        {
            $status = 'wait';

            return view('user.pages.roomates.index',compact('status'));
        }else
        {
            //cek dulu apakah dia ni ada di user request atau engga
            $user_request = UserRequest::where('requested_user_id', Auth::user()->id)
            ->orWhere('user_id', Auth::user()->id)
            ->first();
            // dd($user_request);
            // dd($user_request, Auth::user()->id);
            if($user_request != null)
            {
                // maka dia akan di redirect ke halaman waiting
                if($user_request->requested_user_id == Auth::user()->id)
                {
                    $status = 'requested';
                    $user_request_name = User::find($user_request->user_id)->name;
                    $user_request_id = $user_request->id;
                    return view('user.pages.roomates.index',compact('status','user_request_name', 'user_request_id'));
                }else
                {
                    $status = 'waiting';
                    return view('user.pages.roomates.index',compact('status'));
                }
            }else
            {
                $rommmate_status = Auth::user()->roommate_status;
                $roommate = Roommate::where(function($query) {
                    $query->where('user_id', Auth::user()->id)
                    ->orWhere('requested_user_id', Auth::user()->id);
                    })->first();
                if($rommmate_status == 1)
                {
                    $status = 'accepted';
                    if($roommate->user_id == Auth::user()->id){
                        $roomie = User::find($roommate->requested_user_id);
                    }
                    else{
                        $roomie = User::find($roommate->user_id);
                    }
                    $room = Room::find($roommate->room_id);
                    $roomName = $room->name;
                    $floor = $room->lantai;
                    $status = $roommate->status;
                    return view('user.pages.roomates.index',compact('status','roomName','floor','roomie'));
                }else
                {
                    //kalo misal ga ada, maka statusnya tu null, jadi dia bisa milih
                    if($roommate == null){
                        $status = "not requested";
                        $dataArray = [];
                        $user = Auth::user()->name;
                        $data = escapeshellarg($user);
                
                        exec("python python-script/recommend_roommate.py $data", $output, $return);
                        $output[0] = explode(',', $output[0]);
                        $result = $output[0];
                    
                        //dia nyari apakah dia udah punya roommate atau belum
                        foreach($result as $key => $value)
                        {
                            $user = User::where('name', $value)->first();
                            if($user && ($user->roommate_status == '1' || $user->roommate_status == '2'))
                            {
                                unset($result[$key]);
                            }
                        }
                        return view('user.pages.roomates.index',compact('result', 'status'));
                    }else if($roommate->status == "pending")
                    {
                        $status = "pending";
                        return view('user.pages.roomates.index',compact('status'));
                    }
                }
            }
        }
    }

    public function create()
    {        
        return view('user.pages.roomates.create');
    }

    public function store(Request $request)
    {

        $request->validate([
            'nama' => 'required|string|max:255',
            'kelas' => 'required|string',
            'phone' => 'required',
            'gender' => 'required|string',
            'agama' => 'required|string',
            'lifestyles' => 'required|string',
            'lampu' => 'required|string',
            'kondisi' => 'required|string',
            'belajar' => 'required|string',
            'mekanikal' => 'required|string',
            'outdoor' => 'required|string',
            'medical' => 'required|string',
            'practical' => 'required|string',
            'music' => 'required|string',
            'aesthetic' => 'required|string',
            'korean' => 'required|string',
            'japan' => 'required|string',
        ]);

        $client = new Client();
        $response = $client->post('https://sheetdb.io/api/v1/6n38dr2edrj22' , [
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Accept' => 'application/json',
            ],
            'json' => [
                'Timestamp' => date('Y-m-d H:i:s'),
                'Nama' => $request->get('nama'),
                'Kelas' => $request->get('kelas'),
                'Gender' => $request->get('gender'),
                'Agama' => $request->get('agama'),
                'Lifetsyle' => $request->get('lifestyles'),
                'Bagaimana kondisi lampu kamar Anda saat tidur?' => $request->get('lampu'),
                'Bagaimana kondisi kamar yang Anda harapkan saat tidur?' => $request->get('kondisi'),
                'Bagaimana gaya belajar Anda?' => $request->get('belajar'),
                'Apakah Anda tertarik pada bidang mekanikal (mesin, alat, perkakas, daya mekanik)?' => $request->get('mekanikal'),
                'Apakah Anda tertarik pada aktivitas outdoor (aktivitas rutin di luar seperti olahraga)?' => $request->get('outdoor'),
                'Apakah Anda tertarik pada bidang medical (kesehatan)?' => $request->get('medical'),
                'Apakah Anda tertarik pada bidang praktical (aktivitas yang bisa dilakukan dengan keterampilan)?' => $request->get('practical'),
                'Apakah Anda tertarik pada bidang musical (memainkan, mendengarkan, bernyanyi, atau yang berhubungan dengan musik)?' => $request->get('music'),
                'Apakah Anda tertarik pada bidang aesthetic (aktivitas yang berkaitan dengan keindahan)?' => $request->get('aesthetic'),
                'Apakah Anda tertarik pada budaya Korea (drama, bahasa, lagu , public figure, dll)?' => $request->get('korean'),
                'Apakah Anda tertarik pada budaya Jepang (film, komik, bahasa, lagu , public figure, dll)?' => $request->get('japan'),
                'Berapa suhu AC yang biasa anda gunakan?' => $request->get('suhu'),
                'Apakah agama anda harus sama dengan teman sekamar anda?' => $request->get('agama_sama'),
            ]
        ]);

        $user = Auth::user();
        if($user->name != $request->get('nama')){
            $user->name = $request->get('nama');
            $user->save();
        }

        $user->phone = $request->get('phone');
        $user->form_status = '1';

        $kelas = $request->get('kelas');
        $class = Classes::where('namaKelas', $kelas)->first();
        
        // kaya nya ni ga perlu becos ga jadi input kelas (minimalisir salah input)
        // if($class == null){
        //     $class = new Classes;
        //     $class->namaKelas = $kelas;
        //     $class->save();
        // }

        $user->class_id = $class->id;
        $user->save();

        $class->jumlahSiswa += 1;
        $class->save();

        $options = array(
            'http' => array(
                'method'  => 'GET'
            )
        );
        
        $result = json_decode
        (file_get_contents
            ("https://sheetdb.io/api/v1/6n38dr2edrj22", false, stream_context_create($options))
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

        return redirect()->route('dashboard');
    }

    public function roomates(Request $request)
    {
        $user_id = Auth::user()->id;
        $whatsapp = new WhatsappController;
        
        $user_class = Auth::user()->class_id;
        $user_phone = Auth::user()->phone;

        // cek apakah requstnya single atau engga
        if($request == 'single')
        {
            $roommate = new Roommate;
            $roommate->user_id = $user_id;
            $roomate->requested_user_id ="";
            $roommate->class_id = $user_class;
            $roommate->save();

            try{
                $data = [
                    'toNumber' => $user_phone,
                    'message' => 'Kamu telah request untuk single room, tunggu konfirmasi dari admin'
                ];
    
                // send message
                $whatsapp->sendMessage($data);
            }catch(Exception $e){

            }
        }else
        {
            // kalo misal engga, maka masukin ke table userrequest dan status user ubah jadi 2 
            $name = $request->get('name');

            $requested_user_id = "";
            $users = User::all();
            foreach ($users as $user) {
                if($user->name == $name){
                    $requested_user_id = $user->id;
                }
            }

            //masukin ke user request
            $user_request = new UserRequest;
            $user_request->user_id = Auth::user()->id;
            $user_request->requested_user_id = $requested_user_id;
            $user_request->class_id = $user_class;
            $user_request->save();

            try{
                //send to wa
                $data = [
                    'toNumber' => $user_phone,
                    'message' => 'Kamu telah memilih roommate, silahkan tunggu konfirmasi dari admin :)'
                ];
    
                // send message
                $whatsapp->sendMessage($data);
                // send to wa juga buat yang di request
                $user_name = Auth::user()->name;
                $requested_user_phone = User::where('id', $requested_user_id)->first()->phone;
                $data = [
                    'toNumber' => $requested_user_phone,
                    'message' => 'Kamu telah dipilih oleh '. $user_name .' untuk menjadi roommate, silahkan Accept/Rject di website'
                ];
                $whatsapp->sendMessage($data);

                $user = new User;
                // save status 2 to user and user_requested
                $user->where('id', $user_id)->update(['roommate_status' => '2']);
                $user->where('id', $requested_user_id)->update(['roommate_status' => '2']);

            }catch(Exception $e){

            }
        }


        return redirect()->route('dashboard')->withSuccessMessage('Request sent, please wait for admin confirmation');
    }

    // function to show the request(admin)
    public function show()
    {
        $roommates = Roommate::join('users as u1', 'roommates.user_id', '=', 'u1.id')
                        ->join('users as u2', 'roommates.requested_user_id', '=', 'u2.id')
                        ->join('classes as c', 'roommates.class_id', '=', 'c.id')
                        ->select('roommates.*', 'u1.name as user_name', 'u2.name as requested_user_name', 'c.namaKelas as class_name')
                        ->where('roommates.status', 'pending')
                        ->get();

        $count = $roommates->count();
        if(session('success_message'))
        {
            Alert::success('Success', session('success_message'));
        }
        return view('admin.pages.roomates.index', compact('roommates', 'count'));
    }

    public function details($id)
    {
        $roommates = Roommate::find($id);
        $room = Room::all();
        $roommates = Roommate::join('users as u1', 'roommates.user_id', '=', 'u1.id')
            ->join('users as u2', 'roommates.requested_user_id', '=', 'u2.id')
            ->join('classes as c', 'roommates.class_id', '=', 'c.id')
            ->select('roommates.*', 'u1.name as user_name', 'u2.name as requested_user_name', 'c.namaKelas as class_name','u1.gender as gender')
            ->where('roommates.id', $id)
            ->get();
        
        $gender = '';
        foreach ($roommates as $roommate) {
            $gender = User::find($roommate->user_id)->gender;
            break;
        }

        $room = Room::where('gender', $gender)->where('status', '=','Available')->get();
        $count = $room->count();
        if($count == 0)
        {
            return redirect()->route('rooms.create')->withErrorMessage('No room available, please create a room first');
        }

        // dd($room);   

        return view('admin.pages.roomates.details', compact('roommates','room','count'));
    }


    public function store_details(Request $request, $id)
    {
        $roommate = Roommate::find($id);
        $roommate->room_id = $request->get('room_id');
        $roommate->status = 'accepted';
        $roommate->save();

        $user_id_phone = $roommate->user_id;
        $user = User::find($user_id_phone);
        $user_phone = $user->phone;
        $user_name = $user->name;
        
        try{
            //send to wa
            $data = [
                'toNumber' => $user_phone,
                'message' => 'Request roommate anda telah diterima, silahkan melihat website untuk mengetahui nomer kamar kamu :)'
            ];

            // send message
            $whatsapp = new WhatsappController;
            $whatsapp->sendMessage($data);


            // send to requested user
            $requested_user_id_phone = $roommate->requested_user_id;
            $requested_user = User::find($requested_user_id_phone);
            $requested_user_phone = $requested_user->phone;

            //send to wa
            $data = [
                'toNumber' => $requested_user_phone,
                'message' => 'Roommate kamu adalah '.$user_name.', silahkan melihat website untuk mengetahui nomer kamar kamu :)'
            ];

            // send message
            $whatsapp = new WhatsappController;
            $whatsapp->sendMessage($data);        
        }catch(Exception $e){

        }

        
        $rooms = new Room;
        $rooms = Room::find($request->get('room_id'));
        $rooms->status = 'Not Available';
        $rooms->save();
        // store 1 into roommates_status on user, dan 1 into roommates_status on requested_user
        $user_id = $roommate->user_id;
        $user = User::find($user_id);
        $user->roommate_status = 1;
        $user->save();

        $requested_user_id = $roommate->requested_user_id;
        $requested_user = User::find($requested_user_id);
        $requested_user->roommate_status = 1;
        $requested_user->save();

        return redirect()->route('roommates.show')->withSuccessMessage('Roommate has been accepted');
    }

    public function reject($id)
    {
        $roommate = Roommate::find($id);

        $user_id_phone = $roommate->user_id;
        $user = User::find($user_id_phone);
        $user_phone = $user->phone;
        $user->roommate_status = ' ';
        $user->save();

        $user_name = $user->name;
        $requested_user_name = User::find($roommate->requested_user_id)->name;

        try{
            $data = [
                'toNumber' => $user_phone,
                'message' => 'Request roommate anda dengan '. $requested_user_name.' telah ditolak, silahkan mencari roommate lain :)'
            ];
    
            $whatsapp = new WhatsappController;
            $whatsapp->sendMessage($data);
        }catch(Exception $e){
        
        }

        
        // send to requested user
        $requested_user_id_phone = $roommate->requested_user_id;
        $requested_user = User::find($requested_user_id_phone);
        $requested_user_phone = $requested_user->phone;
        $requested_user->roommate_status = ' ';
        $requested_user->save();

        try{
            //send to wa
            $data = [
                'toNumber' => $requested_user_phone,
                'message' => 'Request roommate anda dengan '. $user_name.' telah ditolak, silahkan mencari roommate lain :)'
            ];

            // send message
            $whatsapp->sendMessage($data);
        }catch(Exception $e){
        
        }
        

        // data hapus dari table roommates
        $roommate->delete();
        return redirect()->route('dashboard');
    }

    public function userAccept($id)
    {
        //get data and pass to roommates table
        $request = UserRequest::find($id);
        $roommates = new Roommate;
        $roommates->user_id = $request->user_id;
        $roommates->requested_user_id = $request->requested_user_id;
        $roommates->class_id = $request->class_id;
        $roommates->save();

        //send to wa
        $user_id_phone = $request->user_id;
        $user = User::find($user_id_phone);
        $user_phone = $user->phone;
        $user_name = $user->name;
        $requested_user_name = User::find($request->requested_user_id)->name;

        try{
            $data = [
                'toNumber' => $user_phone,
                'message' => 'Request roommate anda dengan '. $requested_user_name.' telah diterima, mohon menunggu admin untuk menyetujui :)'
            ];
    
            $whatsapp = new WhatsappController;
            $whatsapp->sendMessage($data);    
        }catch(Exception $e){
        
        }
        
        $request->delete();

        return redirect()->route('dashboard')->withSuccessMessage('Request has been sent');
    }

    public function userReject($id)
    {
        $request = UserRequest::find($id);
        $user_id_phone = $request->user_id;
        $user = User::find($user_id_phone);
        $user_phone = $user->phone;
        $user_name = $user->name;
        $requested_user_name = User::find($request->requested_user_id)->name;

        try{
            $data = [
                'toNumber' => $user_phone,
                'message' => 'Request roommate anda dengan '. $requested_user_name.' telah ditolak, silahkan mencari roommate lain :)'
            ];
    
            $whatsapp = new WhatsappController;
            $whatsapp->sendMessage($data);    
        }catch(Exception $e){
        
        }
        
        //ubah status user_roommate menjadi null
        $user_id = $request->user_id;
        $user = User::find($user_id);
        $user->roommate_status = ' ';
        $user->save();

        //ubah status requested_user_roommate menjadi null
        $requested_user_id = $request->requested_user_id;
        $requested_user = User::find($requested_user_id);
        $requested_user->roommate_status = ' ';
        $requested_user->save();
        
        $request->delete();

        return redirect()->route('dashboard')->withSuccessMessage('Request has Successfully rejected');
    }
}
