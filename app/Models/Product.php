<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [

        'code',
        'name_en',
        'name_cn',
        'desc_en',
        'desc_cn',
        'price',
        'category_id',
        'shipping_quantity',
        'image_1',
        'image_2',
        'image_3',
        'image_4',
        'image_5',
        'status',
        'created_by',
        'updated_by',
    ];

}
