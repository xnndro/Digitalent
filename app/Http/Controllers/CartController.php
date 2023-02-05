<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Cart;

class CartController extends Controller
{
    public function incQty($rowId){
        $product = Cart::get($rowId);
        $qty = $product->qty + 1;
        Cart::update($rowId, $qty);
        Cart::store(Auth::user()->name);
        return redirect()->route('cart');
    }

    public function decQty($rowId){
        $product = Cart::get($rowId);
        $qty = $product->qty - 1;
        Cart::update($rowId, $qty);
        Cart::store(Auth::user()->name);
        return redirect()->route('cart');
    }

    public function delItem($rowId){
        Cart::remove($rowId);
        Cart::store(Auth::user()->name);
        return redirect()->route('cart');
    }

    public function index(){
        return view('user.pages.shopping.cart');
    }
}
