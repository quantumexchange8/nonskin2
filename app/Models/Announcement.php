<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'content',
        'image',
        'start_date',
        'end_date',
        'recipient',
        'status',
        'popup',
        'popup_once',
        'created_by',
        'updated_by',
        'updated_at'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'updated_by', 'id');
    }
}
