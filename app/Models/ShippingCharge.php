<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShippingCharge extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'amount',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by',
    ];

    public function userName()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'name', 'state');
    }

    public function address()
    {
        return $this->belongsTo(Address::class, 'state', 'name');
    }
}
