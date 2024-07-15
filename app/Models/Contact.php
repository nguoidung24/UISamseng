<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $table         = 'contact';
    protected $primaryKey    = 'id';
    protected $fillable      = [
        'last_name',
        'first_name',
        'content',
        'email',
        'created_at',
        'updated_at'
    ];
}
