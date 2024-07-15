<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customers extends Model
{
    protected $table         = 'customers';
    protected $primaryKey    = 'customer_id';
    protected $fillable      = [
        'customer_id',
        'customer_name',
        'password',
        'phone',
        'address',
        'updated_at',
        'created_at',

    ];
    public function order(){
        return $this->hasMany(Order::class,'customer_id','customer_id');
    }
}
