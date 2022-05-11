<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function index(){
        return view('fe.pages.checkout');
    }
    public function create(Request $req){
        $order=Order::create([
            'name'=>$req->name,
            'email'=>$req->email,
            'phone'=>$req->phone,
            'address'=>$req->address,
            'note'=>$req->note,
        ]);
        
    }
}
