<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = 'products';
    protected $fillable = [
        'name',
        'slug',
        'price',
        'sale_price',
        'category_id',
        'image',
        'content',
        'description',
        'shoe_code',
        'status'
    ];
    public function proImg(){
        return $this->hasMany(Product_img::class);
    }
    public function proV(){
        return $this->hasMany(Product_variant::class);
    }
    
}
