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

    public function productDetail($id){
        $product = Product::find($id);
        // dd($product->proV);
        $checkColor=[];
        foreach($product->proV as $item){
            $value=$item->attr_color->value;
            if(!in_array($value,$checkColor)){
                $checkColor[]=$value;
            }
        }
        $checkSize=[];
        foreach($product->proV as $item){
            $value=$item->attr_size->value;
            if(!in_array($value,$checkSize)){
                $checkSize[]=$value;
            }
        }
        return view('fe.pages.detailProduct', compact('product','checkColor','checkSize'));
    }
}
