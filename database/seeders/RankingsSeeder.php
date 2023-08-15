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
            'direct_member' => null,
            'direct_member_rank' => null,
            'rank_short' => 'Client',
            'category' => 'normal'
        ],
        [
            'level' => 2,
            'name' => 'Member',
            'personal_sales' => 600,
            'package_requirement' => 6376,
            'group_sale_requirement' => 0,
            'direct_member' => null,
            'direct_member_rank' => null,
            'rank_short' => 'member',
            'category' => 'normal'
        ],
        [
            'level' => 3,
            'name' => 'General Distributor',
            'personal_sales' => 600,
            'package_requirement' => 16000,
            'group_sale_requirement' => 6376,
            'direct_member' => null,
            'direct_member_rank' => null,
            'rank_short' => 'GD',
            'category' => 'normal'
        ],
        [
            'level' => 4,
            'name' => 'Exclusive Distributor',
            'personal_sales' => 800,
            'package_requirement' => 48000,
            'group_sale_requirement' => 32000,
            'direct_member' => null,
            'direct_member_rank' => null,
            'rank_short' => 'ED',
            'category' => 'normal'
        ],
        [
            'level' => 5,
            'name' => 'Chief Distributor',
            'personal_sales' => 1000,
            'package_requirement' => 143460,
            'group_sale_requirement' => 39000,
            'direct_member' => null,
            'direct_member_rank' => null,
            'rank_short' => 'CD',
            'category' => 'normal'
        ],
        [
            'level' => 1,
            'name' => 'Client',
            'personal_sales' => 0,
            'package_requirement' => 0,
            'group_sale_requirement' => 0,
            'direct_member' => null,
            'direct_member_rank' => null,
            'rank_short' => 'Client',
            'category' => 'promotion'
        ],
        [
            'level' => 2,
            'name' => 'Member',
            'personal_sales' => 600,
            'package_requirement' => 3188,
            'group_sale_requirement' => 0,
            'direct_member' => null,
            'direct_member_rank' => null,
            'rank_short' => 'member',
            'category' => 'promotion'
        ],
        [
            'level' => 3,
            'name' => 'General Distributor',
            'personal_sales' => 600,
            'package_requirement' => 8000,
            'group_sale_requirement' => 3188,
            'direct_member' => null,
            'direct_member_rank' => null,
            'rank_short' => 'GD',
            'category' => 'promotion'
        ],
        [
            'level' => 4,
            'name' => 'Exclusive Distributor',
            'personal_sales' => 800,
            'package_requirement' => 24000,
            'group_sale_requirement' => 16000,
            'direct_member' => null,
            'direct_member_rank' => null,
            'rank_short' => 'ED',
            'category' => 'promotion'
        ],
        [
            'level' => 5,
            'name' => 'Chief Distributor',
            'personal_sales' => 1000,
            'package_requirement' => 71730,
            'group_sale_requirement' => 32000,
            'direct_member' => null,
            'direct_member_rank' => null,
            'rank_short' => 'CD',
            'category' => 'promotion'
        ],
    ];

    public function run()
    {
        foreach ($this->ranks as $rank) {
            Rankings::create($rank);
        }
    }
}
