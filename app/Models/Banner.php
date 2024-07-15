<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    protected $table         = 'banner';
    protected $primaryKey    = 'id';
    protected $fillable      = [
        'type',
        'image',
        'title',
        'subtitle',
        'text',
        'button',
        'button_link',
        'created_at',
        'updated_at'
    ];
}
