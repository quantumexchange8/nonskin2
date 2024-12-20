<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommissionsLogs extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class, 'downline_id', 'id');
    }

    public function rank()
    {
        return $this->belongsTo(Rankings::class, 'downline_rankid', 'id');
    }
}
