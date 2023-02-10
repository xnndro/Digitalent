<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Alert;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        $count = $products->count();
        if(session('success_message'))
            Alert::success('Success', session('success_message')
        );
        return view('admin.pages.shopping.manageProducts', compact('products', 'count'));
    }

    public function create()
    {
        return view('admin.pages.shopping.createProduct');
    }

    public function store(Request $request)
    {
        $product = new Product();
        if($request->hasFile('fotoBarang')){
            $destination_path = 'public/uploads/products/';
            $file = $request->file('fotoBarang');
            $name = $file->getClientOriginalName();
            $path = $request->file('fotoBarang')->storeAs($destination_path, $name);
            $product->fotoBarang = $name;
        }
        $product->name = $request->name;
        $product->price = $request->price;
        $product->stock = $request->stock;
        $product->save();

        return redirect()->route('products.index')->withSuccessMessage('Data Successfully Added!');
    }

    public function edit($id)
    {
        $product = Product::find($id);
        return view('admin.pages.shopping.editProduct', compact('product'));
    }

    public function update(Request $request, $id)
    {
        $product = Product::find($id);
        if($request->hasFile('fotoBarang')){
            $destination_path = 'public/uploads/products/';
            $file = $request->file('fotoBarang');
            $name = $file->getClientOriginalName();
            $path = $request->file('fotoBarang')->storeAs($destination_path, $name);
            $product->fotoBarang = $name;
        }
        $product->name = $request->name;
        $product->price = $request->price;
        $product->stock = $request->stock;
        $product->save();
        return redirect()->route('products.index')->withSuccessMessage('Data Successfully Updated!');
    }

    public function destroy($id)
    {
        $product = Product::find($id);
        $product->delete();
        return redirect()->route('products.index')->withSuccessMessage('Data Successfully Deleted!');
    }
}
