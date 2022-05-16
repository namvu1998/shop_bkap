<?php

namespace App\Helper;

use App\Models\Attribute;
use App\Models\Product;
use App\Models\Product_variant;

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
        $proV_color = Attribute::find($product['color_id_input']);
        $proV_size = Attribute::find($product['size_id_input']);
        $item = [
            'id' => $product['product_id'],
            'name' => $product_order->name,
            'price' => $product_order->price,
            'sale_price' => $product_order->sale_price,
            'image' => $product_order->image,
            'size' =>  $proV_size->value,
            'color' => $proV_color->value,
            'quantity' => $product['quantity'],
        ];
        if (isset($this->items)) {
            // dd(1);
            $check = 0;
            foreach ($this->items as $key=>$data) {
                if($data['id']==$product['product_id'] && $data['color']==$proV_color->value && $data['size']==$proV_size->value){ 
                    $this->items[$key]['quantity'] += $product['quantity'];
                    $check = 1;
                }
            }
           
            if($check != 1){
                $this->items[] = $item;
            }else{
                $check = 0;
            }
        } else {
            $this->items[] = $item;
        }
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
