<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'contact',
        'address_1',
        'address_2',
        'postcode',
        'city',
        'state',
        'country',
        'created_by',
        'updated_by'

    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id', 'id');
    }

    public function shippingCharge()
    {
        return $this->hasOne(ShippingCharge::class, 'name', 'state');
    }
}
