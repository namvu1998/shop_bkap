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

    public function product_variants()
    {
        return $this->belongsTo(product_variant::class, 'product_id', 'color_id', 'size_id');
    }
    public function images()
    {
        return $this->hasMany(Product_img::class);
    }
}
