<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $table = 'orders';
    protected $fillable = [
        "name",
        "email",
        "address",
        "phone",
        "note",
        "status",
        "user_id",
    ];
    const ORDER_NEW = '1';
    const ORDER_PENDING = '2';
    const ORDER_SHIPING = '3';
    const ORDER_COMPLETE = '4';
    const ORDER_CANCEL = '5';
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function orderDetail()
    {
        return $this->hasMany(OrderDetail::class);
    }
}
