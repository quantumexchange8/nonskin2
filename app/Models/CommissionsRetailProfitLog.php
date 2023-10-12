<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommissionsRetailProfitLog extends Model
{
    use HasFactory;

    protected $table = 'nonskin.commissions_retailprofit_logs';

    public function user()
    {
        return $this->belongsTo(User::class, 'upline_id', 'id');
    }

    public function userdownline()
    {
        return $this->belongsTo(User::class, 'downline_id', 'id');
    }

    public function downlinerank()
    {
        return $this->belongsTo(Rankings::class, 'downline_rankid', 'id');
    }

    public function uplinerank()
    {
        return $this->belongsTo(Rankings::class, 'upline_rankid', 'id');
    }
}
