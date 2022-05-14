<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Product_img;
use App\Models\Product_variant;
use Attribute;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index(){
        return view('fe.pages.shop');
    }
    public function test(){
        return view('fe.pages.test');
    }
    public function detailProduct($id)
    {
        $detailProduct = Product::find($id);
        $checkColorId=[];
        $check=[];
        foreach($detailProduct->proV as $item){
            $checkColor=[];
            $value=$item->attr_color->value;
            if(!in_array($value,$check)){
                $check[]=$value;
                $checkColor['value']=$value;
                $checkColor['product_id']=$id;
                $checkColor['color_id']=$item->color_id;
                $checkColorId[]=$checkColor;
            }
          
        }
        // dd($checkColorId);
        $checkSizeId=[];
        $check2=[];
        foreach($detailProduct->proV as $item){
            $checkSize=[];
            $value=$item->attr_size->value;
            if(!in_array($value,$check2)){
                $checkSize['value']=$value;
                $check2[]=$value;
                $checkSize['product_id']=$id;
                $checkSize['size_id']=$item->size_id;
                $checkSizeId[]=$checkSize;
            }
        }
        // dd($checkSizeId);
        $detailProduct->load(['images']);
        $category_id = $detailProduct->category_id;
        $related = Product::where('category_id', $category_id)->where('id', '!=', $id)->get();
        return view('fe.pages.detailProduct', compact('detailProduct', 'category_id', 'related','checkColorId','checkSizeId'));
    }
    public function getSize(Request $req){
        $detailProductV = Product_variant::where('product_id',$req->idPro)->where('color_id',$req->idColor)->get();
        $checkColorSizeId=[];
        foreach($detailProductV as $item){
            $checkSize=[];
            $value=$item->attr_size->value;
            $checkSize['value']=$value;
            $checkSize['product_id']=$req->idPro;
            $checkSize['size_id']=$item->size_id;
            $checkColorSizeId[]=$checkSize;
        }
        return response()->json($checkColorSizeId, 200);
    }
    public function getQty(Request $req){
        $qty = Product_variant::where('product_id',$req->product_id)
        ->where('color_id',$req->color_id)
        ->where('size_id',$req->size_id)->first();
        return response()->json($qty, 200);
    }
}
