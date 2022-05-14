<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $orders = Order::latest()->paginate(10);
        return view('admin.home', compact('orders'));
    }
    public function show($id)
    {
        $order = Order::findOrFail($id);
        $order->load(['orderDetail']);
        return view('admin.order.orderDetail', compact('order'));
    }
}
