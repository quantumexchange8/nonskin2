<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\RankingSetting;


class RankingSeeder extends Seeder
{
    public $ranks = [
        [
            'name' => 'Chief Distributor',
            'desc' => 'Chief Distributor',
            'updated_at' => null,
            'created_by' => 1
        ],
        [
            'name' => 'Exclusive Distributor',
            'desc' => 'Exclusive Distributor',
            'updated_at' => null,
            'created_by' => 1
        ],
        [
            'name' => 'General Distributor',
            'desc' => 'General Distributor',
            'updated_at' => null,
            'created_by' => 1
        ],
        [
            'name' => 'Member',
            'desc' => 'Member',
            'updated_at' => null,
            'created_by' => 1
        ],
        [
            'name' => 'Nonmember',
            'desc' => 'Nonmember',
            'updated_at' => null,
            'created_by' => 1
        ]
    ];

    public function run()
    {
        foreach ($this->ranks as $rank) {
            RankingSetting::create($rank);
        }
    }
}
