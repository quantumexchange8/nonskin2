<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BankSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'updated_by', 'id');
    }
}
