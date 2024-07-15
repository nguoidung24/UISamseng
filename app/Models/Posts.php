<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Posts extends Model
{
    protected $table         = 'posts';
    protected $primaryKey    = 'post_id';
    protected $fillable      = [
        'post_id',
        'post_name',
        'content',
    ];
}
