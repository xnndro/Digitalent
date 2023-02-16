<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\Roommate;
use App\Models\User;
use Alert;

class RoomController extends Controller
{
    public function index()
    {
        $room = Room::all();
        $room = Room::where('status', 'Available')->get();
        $room_not = Room::where('status', 'Not Available')->get();
        $count = $room->count(); 
        $count_not = $room_not->count();

        if(session('success_message'))
        {
            Alert::success('Success', session('success_message'));
        }else if(session('error_message'))
        {
            Alert::error('Error', session('error_message'));
        }
        return view('admin.pages.room.index',compact('room', 'count','room_not','count_not'));
    }

    public function create()
    {
        if(session('error_message'))
        {
            Alert::error('Error', session('error_message'));
        }
        return view('admin.pages.room.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'lantai' => 'required',
            'gender' => 'required',
            // 'status' => 'required',
        ]);

        $request->merge([   
            'name' => $request->name,
            'lantai' => $request->lantai,
            'gender' => $request->gender,
            'status' => 'Available',
        ]);

        $room = Room::create($request->all());

        return redirect()->route('rooms.index')->withSuccessMessage('Room Created Successfully');
    }

    public function history()
    {
        $roommates = Roommate::join('users as u1', 'roommates.user_id', '=', 'u1.id')
            ->join('users as u2', 'roommates.requested_user_id', '=', 'u2.id')
            ->join('classes as c', 'roommates.class_id', '=', 'c.id')
            ->join('rooms as r', 'roommates.room_id', '=', 'r.id')
            ->select('roommates.*', 'u1.name as user_name', 'u2.name as requested_user_name', 'c.namaKelas as class_name','u1.gender as gender', 'r.name as room_name','r.lantai as lantai')
            ->where('roommates.status', 'accepted')
            ->get();

        $count = $roommates->count();
        return view('admin.pages.room.history', compact('roommates', 'count'));
    }

    public function edit($id)
    {
        $room = Room::find($id);
        return view('admin.pages.room.edit', compact('room'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'lantai' => 'required',
            'gender' => 'required',
            // 'status' => 'required',
        ]);

        $request->merge([   
            'name' => $request->name,
            'lantai' => $request->lantai,
            'gender' => $request->gender,
            'status' => 'Available',
        ]);

        $room = Room::find($id);
        $room->update($request->all());

        return redirect()->route('rooms.index')->withSuccessMessage('Room Updated Successfully');
    }

    public function destroy($id)
    {
        $room = Room::find($id);
        $room->delete();

        return redirect()->route('rooms.index')->withSuccessMessage('Room Deleted Successfully');
    }

    public function delete($id)
    {
        $roommates = Roommate::find($id);
        $room_id = $roommates->room_id;

        $room = Room::where('id', $room_id)->first();
        $room->status = 'Available';

        $user_id = $roommates->user_id;
        $user = User::where('id', $user_id)->first();
        $user->roommate_status = null;
        $user->save();

        $requested_user_id = $roommates->requested_user_id;
        $requested_user = User::where('id', $requested_user_id)->first();
        $requested_user->roommate_status = null;
        $requested_user->save();

        $roommates->delete();
        return redirect()->route('rooms.history')->withSuccessMessage('Room Deleted Successfully');
    }
}
