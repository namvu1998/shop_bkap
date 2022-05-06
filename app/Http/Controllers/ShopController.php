<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index(){
        return view('fe.pages.shop');
    }

    public function productDetail(){
        return view('fe.pages.detailProduct');
    }
}
