<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Prefix;

class PrefixSeeder extends Seeder
{
    public $prefixes =[
        [
            'prefix' => 'NON',
            'padding' => 9,
            'counter' => 6,
            'description' => 'Member ID or Referrer ID. Each member has unique Referrer ID for referral purpose',
            'updated_at' => null,
            'created_by' => 1
        ],
        [
            'prefix' => 'NONOD',
            'padding' => 9,
            'description' => 'Order No',
            'updated_at' => null,
            'created_by' => 1
        ],
        [
            'prefix' => 'NONT',
            'padding' => 9,
            'description' => 'Transaction No',
            'updated_at' => null,
            'created_by' => 1
        ],
        [
            'prefix' => 'NONIT',
            'padding' => 9,
            'description' => 'Internal Transfer No',
            'updated_at' => null,
            'created_by' => 1
        ]
    ];

    public function run()
    {
        foreach ($this->prefixes as $prefix) {
            Prefix::create($prefix);
        }
    }
}
