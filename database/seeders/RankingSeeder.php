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
            'created_by' => 1,
        ],
        [
            'name' => 'Exclusive Distributor',
            'desc' => 'Exclusive Distributor',
            'created_by' => 1,
        ],
        [
            'name' => 'General Distributor',
            'desc' => 'General Distributor',
            'created_by' => 1,
        ],
        [
            'name' => 'Member',
            'desc' => 'Member',
            'created_by' => 1,
        ],
        [
            'name' => 'Nonmember',
            'desc' => 'Nonmember',
            'created_by' => 1,
        ]
    ];

    public function run()
    {
        foreach ($this->ranks as $rank) {
            RankingSetting::create($rank);
        }
    }
}
