<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name_en',
        'name_cn',
        'status',
        'remarks',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by',
    ];

    public function products() {
        return $this->hasMany(Product::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }
}
