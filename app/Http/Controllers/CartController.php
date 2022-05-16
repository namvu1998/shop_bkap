<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Helper\CartHelper;

class CartController extends Controller
{
    public function index()
    {
        return view('fe.pages.cart');
    }
    public function AddCart(CartHelper $cart, Request $request)
    {
        
        // $carts = session()->get('cart');
        $cart->add($request->all());
        return redirect()->route('cart');
    }
    public function ShowCart()
    {
        $carts = session()->get('cart');
        return view('fe.pages.cart', compact('carts'));
    }
    public function DeleteCart(CartHelper $cart, $id)
    {
        $cart->remove($id);
        return redirect()->back();
    }
    public function UpdateCart(CartHelper $cart,Request $req)
    {
       
        $cart->update($req->all());
        return redirect()->back();
    }
    public function Clear(CartHelper $cart)
    {
        $cart->clear();
        return redirect()->back();
    }
    
}
