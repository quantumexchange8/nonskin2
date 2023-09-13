<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RankingUpdateLog extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function oldRank()
    {
        return $this->belongsTo(Rankings::class, 'old_rank', 'id');
    }

    public function newRank()
    {
        return $this->belongsTo(Rankings::class, 'new_rank', 'id');
    }
}
