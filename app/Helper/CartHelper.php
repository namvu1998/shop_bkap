<?php

namespace App\Helper;

use App\Models\Product;

class CartHelper
{
    public $items = [];
    public $total_quantity = 0;
    public $total_price = 0;
    public function __construct()
    {
        $this->items = session('cart') ? session('cart') : [];
        $this->total_price = $this->get_total_price();
        $this->total_quantity = $this->get_total_quantity();
    }
    public function add($product)
    {
       
        $product_order = Product::find($product['product_id']);

        $item = [
            'id' => $product['product_id'],
            'name' => $product_order->name,
            'price' => $product_order->price,
            'sale_price' => $product_order->sale_price,
            'image' => $product_order->image,
            'size' => $product['size_id_input'],
            'color' => $product['color_id_input'],
            'quantity' => $product['quantity'],
        ];

        if (isset($this->items[$product['product_id']])) {
            foreach ($this->items[$product['product_id']] as $product1) {
                $product1['quantity'] += $product['quantity'];
            }
        } else {
            $this->items[] = $item;
        }
        // dd($this->items);
        // dd(session('cart'));
        session(['cart' => $this->items]);
    }
    public function remove($id)
    {
        if (isset($this->items[$id])) {
            unset($this->items[$id]);
        }
    }
    public function update($req)
    {
        $finaldata=[];
            foreach($req['product_id'] as $key=>$product_id){
                if ($product_id) {
                    foreach($req['qtybutton'] as $key1=>$qty){
                        var_dump($key1);
                        if($key1==$key){
                            foreach($this->items as $data){
                             $data['quantity'] = $qty;
                            }
                            $finaldata[]=$data; 
                        }
                    }
                }            
            }
        
        session(['cart' => $finaldata]);
       
    }
    public function clear()
    {
        session(['cart' => '']);
    }
    private function get_total_price()
    {
        $total = 0;
        foreach ($this->items as $item) {
            $total += 0;
        }
        return $total;
    }
    private function get_total_quantity()
    {
        $total = 0;
        foreach ($this->items as $item) {
            $total += 0;
        }
        return $total;
    }
}
