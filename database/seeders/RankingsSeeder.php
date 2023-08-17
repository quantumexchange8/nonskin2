<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Rankings;


class RankingsSeeder extends Seeder
{
    public $ranks = [
        [
            'level' => 1,
            'name' => 'Client',
            'personal_sales' => 0, 
            'package_requirement' => 0,
            'group_sale_requirement' => 0,
            'group_package' => 0,
            'rank_short' => 'Client',
            'category' => 'normal',
            'upgrade_ranking_sales' => 0,
            'upgrade_level' => 0,
        ],
        [
            'level' => 2,
            'name' => 'Member',
            'personal_sales' => 600,
            'package_requirement' => 6376,
            'group_sale_requirement' => 0,
            'group_package' => 0,
            'rank_short' => 'member',
            'category' => 'normal',
            'upgrade_ranking_sales' => 0,
            'upgrade_level' => 10,
        ],
        [
            'level' => 3,
            'name' => 'General Distributor',
            'personal_sales' => 600,
            'package_requirement' => 16000,
            'group_sale_requirement' => 6376,
            'group_package' => 0,
            'rank_short' => 'GD',
            'category' => 'normal',
            'upgrade_ranking_sales' => 0,
            'upgrade_level' => 20,
        ],
        [
            'level' => 4,
            'name' => 'Exclusive Distributor',
            'personal_sales' => 800,
            'package_requirement' => 48000,
            'group_sale_requirement' => 32000,
            'group_package' => 0,
            'rank_short' => 'ED',
            'category' => 'normal',
            'upgrade_ranking_sales' => 0,
            'upgrade_level' => 30,
        ],
        [
            'level' => 5,
            'name' => 'Chief Distributor',
            'personal_sales' => 1000,
            'package_requirement' => 0,
            'group_sale_requirement' => 39000,
            'group_package' => 0,
            'rank_short' => 'CD',
            'category' => 'normal',
            'upgrade_ranking_sales' => 0,
            'upgrade_level' => 42,
        ],
        [
            'level' => 1,
            'name' => 'Client',
            'personal_sales' => 0,
            'package_requirement' => 0,
            'group_sale_requirement' => 0,
            'group_package' => 0,
            'rank_short' => 'Client',
            'category' => 'promotion',
            'upgrade_ranking_sales' => 0,
            'upgrade_level' => 0,
        ],
        [
            'level' => 2,
            'name' => 'Member',
            'personal_sales' => 600,
            'package_requirement' => 3188,
            'group_sale_requirement' => 0,
            'group_package' => 0,
            'rank_short' => 'member',
            'category' => 'promotion',
            'upgrade_ranking_sales' => 0,
            'upgrade_level' => 10,
        ],
        [
            'level' => 3,
            'name' => 'General Distributor',
            'personal_sales' => 600,
            'package_requirement' => 8000,
            'group_sale_requirement' => 3188,
            'group_package' => 0,
            'rank_short' => 'GD',
            'category' => 'promotion',
            'upgrade_ranking_sales' => 0,
            'upgrade_level' => 35,
        ],
        [
            'level' => 4,
            'name' => 'Exclusive Distributor',
            'personal_sales' => 800,
            'package_requirement' => 24000,
            'group_sale_requirement' => 16000,
            'group_package' => 0,
            'rank_short' => 'ED',
            'category' => 'promotion',
            'upgrade_ranking_sales' => 0,
            'upgrade_level' => 45,
        ],
        [
            'level' => 5,
            'name' => 'Chief Distributor',
            'personal_sales' => 1000,
            'package_requirement' => 0,
            'group_sale_requirement' => 32000,
            'group_package' => 0,
            'rank_short' => 'CD',
            'category' => 'promotion',
            'upgrade_ranking_sales' => 0,
            'upgrade_level' => 50,
        ],
    ];

    public function run()
    {
        foreach ($this->ranks as $rank) {
            Rankings::create($rank);
        }
    }
}
