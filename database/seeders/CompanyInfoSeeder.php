<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CompanyInfo;

class CompanyInfoSeeder extends Seeder
{
    public $infos = [
        [
            'key' => 'Name',
            'value' => 'Non Sdn Bhd',
        ],
        [
            'key' => 'Address',
            'value' => 'A-GF-07 Sky Park @ One City, Jalan USJ25/1, 47650 Subang Jaya, Selangor.',
        ],
        [
            'key' => 'Contact',
            'value' => '(+60) 10 563 5811',
        ],
        [
            'key' => 'Register No',
            'value' => '1298076-T',
        ]
        ];
    public function run()
    {
        foreach ($this->infos as $info) {
            CompanyInfo::create($info);
        }
    }
}
