<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    protected $table         = 'products';
    protected $primaryKey    = 'product_id';
    protected $fillable      = [
        'product_id',
        'category_id',
        'color_id',
        'product_name',
        'product_type',
        'sold',
        'price',
        'rating',
        'total_rating',
        'status',
        'thumbnail',
        'discount',
        'quantity',
        'group_id',
        'created_at',
        'updated_at'
    ];
    public function color() {
        return $this->hasOne(Color::class, 'color_id', 'color_id');
        
    }
    public function category() {
        return $this->hasOne(Category::class, 'category_id', 'category_id');
        
    }
}
