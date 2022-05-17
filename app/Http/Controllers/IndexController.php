<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index()
    {
        $products = Product::latest()->paginate(8);
        $product_sale = Product::where('sale_price','>','0')->latest()->paginate(8);
        return view('fe.pages.home', compact('products','product_sale'));
    }
    public function detailProduct($id)
    {
        $detailProduct = Product::find($id);
        $detailProduct->load(['images']);
        $category_id = $detailProduct->category_id;
        $related = Product::where('category_id', $category_id)->where('id', '!=', $id)->get();
        return view('fe.pages.detailProduct', compact('detailProduct', 'category_id', 'related'));
    }
}
