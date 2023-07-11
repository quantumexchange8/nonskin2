<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    public static function boot()
{
    parent::boot();
    static::creating(function ($invoice) {
        $current_prefix = $get_active_prefix_model;
        $invoice->number = Invoice::where('prefix_id', $current_prefix->id)->max('number') + 1;
        $invoice->bill_number = $current_prefix->name . '-' . str_pad(
            $invoice->number,
            7, // as per your requirement.
            '0',
            STR_PAD_LEFT
        );
    });
}
}
