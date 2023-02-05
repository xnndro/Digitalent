<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;
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
        }
        return view('admin.pages.room.index',compact('room', 'count','room_not','count_not'));
    }

    public function create()
    {
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
        $rooms = Room::where('status', 'Not Available')->get();
        $count = $rooms->count();
        return view('admin.pages.room.history', compact('rooms','count'));
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
            'type' => 'required',
            'price' => 'required',
            'description' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imageName = time().'.'.$request->image->extension();  
        $request->image->move(public_path('images'), $imageName);

        $room = Room::find($id);
        $room->name = $request->name;
        $room->type = $request->type;
        $room->price = $request->price;
        $room->description = $request->description;
        $room->image = $imageName;
        $room->save();

        return redirect()->route('rooms.index')->withSuccessMessage('Room Updated Successfully');
    }

    public function destroy($id)
    {
        $room = Room::find($id);
        $room->delete();

        return redirect()->route('rooms.index')->withSuccessMessage('Room Deleted Successfully');
    }
}
