<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BroadcastMessage;
use App\Http\Controllers\WhatsAppController;
use App\Models\User;
use Alert;

class BroadcastController extends Controller
{
    public function index()
    {
        $broadcast = BroadcastMessage::all();
        $broadcast = BroadcastMessage::orderBy('created_at', 'desc')->get();
        // $count = 0;
        $count = BroadcastMessage::count();
        if(session('success_message'))
        {
            Alert::success('Success', session('success_message'));
        }

        $broadcast = BroadcastMessage::paginate(5);
        return view('admin.pages.broadcast.index',compact('count', 'broadcast'));
    }

    public function create()
    {
        return view('admin.pages.broadcast.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'message' => 'required',
        ]);

        $request->merge([
            'title' => $request->title,
            'message' => $request->message,
            'status' => 'unbroadcasted',
            'tanggal' => date('Y-m-d'),
        ]);

        $broadcast = BroadcastMessage::create($request->all());

        return redirect()->route('broadcast.index')->withSuccessMessage('Broadcast Created Successfully');
    }

    public function destroy($id)
    {
        $broadcast = BroadcastMessage::find($id);
        $broadcast->delete();

        return redirect()->route('broadcast.index');
    }

    // 088275169992
}
