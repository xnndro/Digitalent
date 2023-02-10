<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Classes;
use Alert;
use App\Models\User;

class ClassController extends Controller
{
    public function index()
    {
        $class = Classes::all();
        $count = $class->count();
        if(session('success_message'))
            Alert::success('Success', session('success_message')
        );
        return view('admin.pages.class.index', compact('class', 'count'));
    }

    public function create()
    {
        return view('admin.pages.class.create');
    }

    public function store(Request $request)
    {
        $class = new Classes();
        $class->namaKelas = $request->name;
        $class->save();
        return redirect()->route('class.index')->withSuccessMessage('Data Successfully Added!');
    }

    public function edit($id)
    {
        $class = Classes::find($id);
        return view('admin.pages.class.edit', compact('class'));
    }

    public function update(Request $request, $id)
    {
        $class = Classes::find($id);
        $class->namaKelas = $request->name;
        $class->save();
        return redirect()->route('class.index')->withSuccessMessage('Data Successfully Updated!');
    }

    public function destroy($id)
    {
        $class = Classes::find($id);
        $user = User::where('class_id', $id)->get();
        foreach($user as $u){
            $u->delete();
        }
        $class->delete();
        return redirect()->route('class.index')->withSuccessMessage('Data Successfully Deleted!');
    }

    public function status($id)
    {
        $class = Classes::find($id);
        $class->status = 'Lulus';
        $class->save();
        return redirect()->route('class.index')->withSuccessMessage('Data Successfully Updated!');
    }
}
