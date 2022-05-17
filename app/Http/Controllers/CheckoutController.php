<?php

namespace App\Http\Controllers;

use App\Helper\CartHelper;
use App\Http\Requests\CheckoutRequest;
use App\Models\Attribute ;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\Product_variant;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function index(){
        $carts = session()->get('cart');
        return view('fe.pages.checkout', compact('carts'));
    }
    public function create(CartHelper $cart,CheckoutRequest $req){
        $order=Order::create([
            'name'=>$req->name,
            'email'=>$req->email,
            'phone'=>$req->phone,
            'address'=>$req->address,
            'note'=>$req->note,
        ]);
        foreach($req->product_id as $key => $data){
            // dd($data);
            // dd($req->color[$key]);
            $product = Product::find($data);
            $color = Attribute::where('value', $req->color[$key])->first();
            $size = Attribute::where('value', $req->size[$key])->first();
            $productV = Product_variant::where('product_id',$data)
            ->where('color_id',$color->id)
            ->where('size_id',$size->id)->first();
            if($productV->quantity >= $req->quantity[$key]){
                $orderDetail= OrderDetail::create([
                    'order_id'=>$order->id,
                    'product_name'=>$product->name,
                    'product_id'=>$data,
                    'color_id'=>$req->color[$key],
                    'size_id' =>$req->size[$key],
                    'quantity' =>$req->quantity[$key],
                    'price' =>$req->price[$key],
                ]);
                $productV->update([
                    'quantity'=> $productV->quantity -= $req->quantity[$key]
                ]);
                $cart->clear();
                return redirect()->route('shop')->with('success',"Đăt hàng thành công");
            }else{
                return redirect()->route('cart')->with('success', "Số lượng sản phẩm $product->name bạn mua lớn hơn số lượng trong kho!");
            }
            
        }
        
    }
}
