<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Menu;

class Category extends Model
{
    protected $table         = 'category';
    protected $primaryKey    = 'category_id';
    protected $fillable      = [
        'category_id',
        'category_name',
        'menu_id',
        'thumbnail',
        'parent_id',
        'created_at',
        'updated_at'
    ];
    public function menu()
    {
        return $this->hasOne(Menu::class, 'menu_id', 'menu_id');
    }
}
