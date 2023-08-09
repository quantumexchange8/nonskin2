<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Ranking;


class RankingSeeder extends Seeder
{
    public $ranks = [
        [
            'name' => 'Client',
            'package_requirement' => '',
            'group_sale_requirement' => '',
            'updated_at' => null,
            'rank_short' => ''
        ],
        [
            'name' => 'Member',
            'package_requirement' => '',
            'group_sale_requirement' => '',
            'updated_at' => null,
            'rank_short' => ''
        ],
        [
            'name' => 'General Distributor',
            'package_requirement' => '',
            'group_sale_requirement' => '',
            'updated_at' => null,
            'rank_short' => ''
        ],
        [
            'name' => 'Exclusive Distributor',
            'package_requirement' => '',
            'group_sale_requirement' => '',
            'updated_at' => null,
            'rank_short' => ''
        ],
        [
            'name' => 'Chief Distributor',
            'package_requirement' => '',
            'group_sale_requirement' => '',
            'updated_at' => null,
            'rank_short' => ''
        ],
    ];

    public function run()
    {
        foreach ($this->ranks as $rank) {
            Ranking::create($rank);
        }
    }
}
