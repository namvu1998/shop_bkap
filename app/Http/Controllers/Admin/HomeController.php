<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attribute;
use App\Models\Order;
use App\Models\Product;
use App\Models\Product_variant;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $orders = Order::latest()->orderBy('id','DESC')->paginate(10);
        return view('admin.home', compact('orders'));
    }
    public function show($id)
    {
        $order = Order::findOrFail($id);
        $order->load(['orderDetail']);
        // foreach($order->orderDetail as $item){
        //     $color = Attribute::where('value', $item->color_id)->first();
        //     $size = Attribute::where('value', $item->size_id)->first();
        //     dd($item->color_id);
        //     $productV = Product_variant::where('product_id',$item->product_id)
        //     ->where('color_id',$color->id)
        //     ->where('size_id',$size->id)->first();
        //     $productV->update([
        //         'quantity'=> $productV->quantity += $item->quantity,
        //     ]);
        // }
        return view('admin.order.orderDetail', compact('order','id'));
    }
    public function updateStatus($id,Request $req)
    {
        $status = Order::findOrFail($id);
        $status->load(['orderDetail']);
       
        if($status->status != 5){
            if($req->status == 5){
                
                foreach($status->orderDetail as $item){
                    $color = Attribute::where('value', $item->color_id)->first();
                    $size = Attribute::where('value', $item->size_id)->first();
                    $productV = Product_variant::where('product_id',$item->product_id)
                    ->where('color_id',$color->id)
                    ->where('size_id',$size->id)->first();
                    $productV->update([
                        'quantity'=> $productV->quantity += $item->quantity,
                    ]);
                }
            }
            $status->update([
                'status'=> $req->status,
            ]);
            return redirect()->back()->with('success',"Thay đổi trạng thái thành công ");
        }else{

            return redirect()->back()->with('success',"Không thể thay đổi trạng thái");
        }
    }
}
