<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;

class Menu extends Model
{
    protected $table         = 'menu';
    protected $primaryKey    = 'menu_id';
    protected $fillable      = [
        'menu_id',
        'menu_name',
        'display_name',
        // 'position',
        'parent_id',
        'created_at',
        'updated_at'
    ];
    public function menu()
    {
        return $this->hasMany(Category::class, 'menu_id', 'menu_id');
    }
}
