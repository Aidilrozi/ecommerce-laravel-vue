<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    public function orderProduct()
    {
        return $this->hasMany(OrderProduct::class)->orderBy('id', 'ASC');
    }
    public function customer()
    {
        return $this->belongsTo(User::class, 'customer_id');
    }
}
