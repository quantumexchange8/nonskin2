<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ranking extends Model
{
    use HasFactory, SoftDeletes;

    const client = 1;
    const member = 2;
    const general_distributor = 3;
    const exclusive_distributor = 4;
    const chief_distributor = 5;

    public function promotionOrdersLogs()
    {
        return $this->hasMany(DateTimeLogs::class);
    }
}
