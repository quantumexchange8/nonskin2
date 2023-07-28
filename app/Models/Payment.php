<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'payment_num',
        'type',
        'user_id',
        'amount',
        'gateway',
        'status',
        'remarks',
        'receipt',
        'bank_name',
        'bank_holder_name',
        'bank_acc_no',
        'bank_ic',
        'reason',
        'created_by',
        'updated_by'
    ];

    public function order()
    {
        return $this->hasOne(Order::class, 'payment_id', 'id');
    }
}
