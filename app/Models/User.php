<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'full_name',
        'email',
        'password',
        'avatar',
        'upline_id',
        'referrer_id',
        'hierarchyList',
        'id_no',
        'contact',
        'username',
        'ranking_id',
        'ranking_name',
        'role_id',
        'role',
        'address_1',
        'address_2',
        'city',
        'postcode',
        'state',
        'country',
        'delivery_address_1',
        'delivery_address_2',
        'delivery_city',
        'delivery_postcode',
        'delivery_state',
        'delivery_country',
        'bank_name',
        'bank_holder_name',
        'bank_acc_no',
        'bank_ic',
        'rank_id',
        // 'created_by',
        'created_at',
        // 'updated_by',
        'updated_at'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function cart()
    {
        return $this->hasOne(Cart::class);
    }

    public function shippingCharge()
    {
        return $this->hasOne(ShippingCharge::class, 'name', 'delivery_state');
    }

    public function address()
    {
        return $this->hasMany(Address::class, 'user_id', 'id');
    }

    public function upline()
    {
        return $this->belongsTo(User::class, 'upline_id', 'id');
    }

    public function rank()
    {
        return $this->hasOne(Rankings::class, 'id', 'rank_id');
    }

    public function orders()
    {
        return $this->hasMany(Order::class, 'user_id', 'id');
    }
}
