<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product_variant extends Model
{
    use HasFactory;
    protected $table = 'product_variants';
    protected $fillable = [
        'product_id',
        'color_id',
        'size_id',
        'quantity',
    ];
    public function attr_color()
    {
        return $this->belongsTo(Attribute::class, 'color_id');
    }
    public function attr_size()
    {
        return $this->belongsTo(Attribute::class, 'size_id');
    }
}
