<?php

namespace App\Http\Controllers;

use App\Http\Requests\CheckoutRequest;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function index(){
        $carts = session()->get('cart');
        return view('fe.pages.checkout', compact('carts'));
    }
    public function create(CheckoutRequest $req){
        $order=Order::create([
            'name'=>$req->name,
            'email'=>$req->email,
            'phone'=>$req->phone,
            'address'=>$req->address,
            'note'=>$req->note,
        ]);
        foreach($req->product_id as $key => $data){
            // dd($data);
            $product = Product::find($data);
            // dd($product);
            $orderDetail= OrderDetail::create([
                'order_id'=>$order->id,
                'product_name'=>$product->name,
                'product_id'=>$data,
                'color_id'=>$req->color_id[$key],
                'size_id' =>$req->size_id[$key],
                'quantity' =>$req->quantity[$key],
                'price' =>$req->price[$key],
            ]);
        }
        
    }
}
