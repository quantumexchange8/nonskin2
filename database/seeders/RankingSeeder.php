<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\RankingSetting;


class RankingSeeder extends Seeder
{
    public $rankings = [
        [
            'name' => 'Chief Distributor',
            'created_by' => 1,
            'updated_by' => 1
        ],
        [
            'name' => 'Exclusive Distributor',
            'created_by' => 1,
            'updated_by' => 1
        ],
        [
            'name' => 'General Distributor',
            'created_by' => 1,
            'updated_by' => 1
        ],
        [
            'name' => 'Member',
            'created_by' => 1,
            'updated_by' => 1
        ],
        [
            'name' => 'Nonmember',
            'created_by' => 1,
            'updated_by' => 1
        ]
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {
        foreach ($this->rankings as $ranking) {
            RankingSetting::create($ranking);
        }
    }
}
