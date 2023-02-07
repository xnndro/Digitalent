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
            $roommate = Roommate::where(function($query) {
                $query->where('user_id', Auth::user()->id)
                ->orWhere('requested_user_id', Auth::user()->id);
                })->first();

            if($roommate == null){
                $status = "not requested";
                $dataArray = [];
                $user = Auth::user()->name;
                $data = escapeshellarg($user);
        
                exec("python python-script/recommend_roommate.py $data", $output, $return);
                $output[0] = explode(',', $output[0]);
                $result = $output[0];

                foreach($result as $key => $value)
                {
                    $user = User::where('name', $value)->first();
                    if($user->roommate_status == 1)
                    {
                        unset($result[$key]);
                    }
                }

                return view('user.pages.roomates.index',compact('result', 'status'));
            }else if($roommate->status == "pending")
            {
                $status = "pending";
                return view('user.pages.roomates.index',compact('status'));
            }else{
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
        $response = $client->post('https://sheetdb.io/api/v1/azny6h0q2lrka' , [
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

        return redirect()->route('dashboard');
    }

    public function roomates(Request $request)
    {
        $user_id = Auth::user()->id;
        $whatsapp = new WhatsappController;
        $roommate = new Roommate;
        $user_class = Auth::user()->class_id;
        $user_phone = Auth::user()->phone;



        if($request == 'single')
        {
            $roommate->user_id = $user_id;
            $roomate->requested_user_id ="";
            $roommate->class_id = $user_class;
            $roommate->save();

            $data = [
                'toNumber' => $user_phone,
                'message' => 'Kamu telah request untuk single room, tunggu konfirmasi dari admin'
            ];

            // send message
            $whatsapp->sendMessage($data);
        }else
        {
            $name = $request->get('name');

            $requested_user_id = "";
            $users = User::all();
            foreach ($users as $user) {
                if($user->name == $name){
                    $requested_user_id = $user->id;
                }
            }
            
            $roommate->user_id = $user_id;
            $roommate->requested_user_id = $requested_user_id;
            $roommate->class_id = $user_class;

            // check jika $requested_user_id ternyata di request oleh orang lain, maka reject request orang lain
            $roommate_check = Roommate::where('requested_user_id', $requested_user_id)->first();
            $roommate_check2 = Roommate::where('user_id', $requested_user_id)->first();
            if($roommate_check != null || $roommate_check2 != null){
                $roommate_check->status = 'rejected';
                $roommate_check->save();
            }
            $roommate->save();


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
                'message' => 'Kamu telah dipilih oleh '. $user_name .' untuk menjadi roommate, silahkan tunggu konfirmasi dari admin :)'
            ];
            $whatsapp->sendMessage($data);
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
                        ->where('roommates.status', 'pending')
                        ->get();
        $gender = '';
        foreach ($roommates as $roommate) {
            $gender = User::find($roommate->user_id)->gender;
            break;
        }

        $room = Room::where('gender', $gender)->where('status', '=','Available')->get();
        $count = $room->count();

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

        $user_name = $user->name;
        $requested_user_name = User::find($roommate->requested_user_id)->name;

        $data = [
            'toNumber' => $user_phone,
            'message' => 'Request roommate anda dengan '. $requested_user_name.' telah ditolak, silahkan mencari roommate lain :)'
        ];

        $whatsapp = new WhatsappController;
        $whatsapp->sendMessage($data);

        // send to requested user
        $requested_user_id_phone = $roommate->requested_user_id;
        $requested_user = User::find($requested_user_id_phone);
        $requested_user_phone = $requested_user->phone;

        //send to wa
        $data = [
            'toNumber' => $requested_user_phone,
            'message' => 'Request roommate anda dengan '. $user_name.' telah ditolak, silahkan mencari roommate lain :)'
        ];

        // send message
        $whatsapp->sendMessage($data);


        // data hapus dari table roommates
        $roommate->delete();
        return redirect()->route('dashboard');
    }
}
