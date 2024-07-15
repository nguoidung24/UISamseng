<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table         = 'orders';
    protected $primaryKey    = 'order_id';
    protected $fillable      = [
        'order_id',
        'customer_id',
        'product_id',
        'price',
        'quantity',
        'status',
        'local',
        'order_date',
        'payment_date',
        'created_at', 
        'updated_at'
    ];
    public function product()
    {
        return $this->hasOne(Products::class, 'product_id', 'product_id');
    }
}
