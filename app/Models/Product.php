<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [

        'code',
        'name',
        'description',
        'price',
        'discount',
        'category_id',
        'shipping_quantity',
        'image_1',
        'image_2',
        'image_3',
        'image_4',
        'image_5',
        'image_6',
        'image_7',
        'image_8',
        'image_9',
        'status',
        'remarks',
        'created_by',
        'updated_by',
    ];

    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function cartItem(): HasOne
    {
        return $this->hasOne(CartItem::class, 'product_id', 'id');
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

}
