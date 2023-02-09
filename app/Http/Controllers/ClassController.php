<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Classes;

class ClassController extends Controller
{
    public function index()
    {
        return view('admin.pages.class.index');
    }

    public function create()
    {
        return view('admin.pages.class.create');
    }

    public function store(Request $request)
    {
        
    }

    public function edit($id)
    {

    }

    public function status($id)
    {
        
    }
}
