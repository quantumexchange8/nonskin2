<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'payment_id',
        'created_by',
        'status',
        'remarks',
        'courier',
        'cn',
        'tracking_number',
    ];

    // STATUS FOR ORDER
    const processing = 1; //for every order start
    const packing = 2; //can be selfpickup and ship
    const delivering = 3; //shipping
    const complete = 4; // succesfully
    const cancel = 5; //cancel or pending refund
    const reject = 6; //reject
    const pending_payment = 9; //pending payment

    /**
     * Get all of the orderItems for the Order
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class, 'order_num', 'order_num');
    }

    public function payment()
    {
        return $this->belongsTo(Payment::class, 'payment_id', 'id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

}
