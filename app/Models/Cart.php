<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\CartItem;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'total_price',
        'total_discount',
        'created_by',
        'updated_by'
    ];

    public function product() {
        return $this->belongsTo(Product::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function items() {
        return $this->hasMany(CartItem::class);
    }

    public function cartItem(): \Illuminate\Database\Eloquent\Relations\hasMany
    {
        return $this->hasMany(CartItem::class, 'cart_id', 'id');
    }

}
