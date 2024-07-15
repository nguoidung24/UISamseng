<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    protected $table         = 'colors';
    protected $primaryKey    = 'color_id';
    protected $fillable      = [
        'color_id',
        'value',
        'created_at',
        'updated_at'
    ];
}
