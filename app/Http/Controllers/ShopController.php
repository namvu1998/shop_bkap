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
            $checkColor=[];
            $checkColorId=[];
        foreach($detailProduct->proV as $item){
            $value=$item->attr_color->value;
            if(!in_array($value,$checkColor)){
                $checkColor[]=$value;
            }
            if(!in_array($item->color_id,$checkColorId)){
                $checkColorId[]=$item->color_id;
            }
        }
        // dd($checkColorId);
        $checkSize=[];
        foreach($detailProduct->proV as $item){
            $value=$item->attr_size->value;
            if(!in_array($value,$checkSize)){
                $checkSize[]=$value;
            }
        }
        $detailProduct->load(['images']);
        $category_id = $detailProduct->category_id;
        $related = Product::where('category_id', $category_id)->where('id', '!=', $id)->get();
        return view('fe.pages.detailProduct', compact('detailProduct', 'category_id', 'related','checkColor','checkSize'));
    }
}
