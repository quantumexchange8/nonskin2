<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prefix extends Model
{
    use HasFactory;

    protected $fillable = [
        'prefix',
        'counter',
        'padding',
        'description',
        'created_by',
        'updated_by'
    ];
}
