<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\User;
use Cart;

class ShopController extends Controller
{
    public function addToCart($product_id, $product_name, $product_price){
        Cart::add($product_id, $product_name, 1, $product_price)->associate('\App\Models\Product');
        Cart::store(Auth::user()->name);
        // session()->flash('success_msg', 'Item added');
        return redirect()->route('shop');
    }

    public function index(){
        $products = Product::all();
        $count = $products->count();
        return view('user.pages.shopping.shop', compact('products', 'count'));
    }

    public function admin_index(){
        $products = Product::all();
        return view('admin.pages.shopping.manageProducts', ['products' => $products]);
    }
}
