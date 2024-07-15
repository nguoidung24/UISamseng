<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Outstanding extends Model
{
    protected $table         = 'outstanding';
    protected $primaryKey    = 'id';
    protected $fillable      = [
        'name',
        'button',
        'button_link',
        'big_text',
        'smaill_text',
        'big_image',
        'small_image',
        'created_at',
        'updated_at'
    ];
}
