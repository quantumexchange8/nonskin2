<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CompanyInfo;

class CompanyInfoSeeder extends Seeder
{
    public $infos = [
        [
            'name' => 'Non Sdn Bhd',
            'address' => 'A-GF-07 Sky Park @ One City, Jalan USJ25/1, 47650 Subang Jaya, Selangor.',
            'contact' => '(+60) 10 563 5811',
            'register_no' => '1298076-T',
        ]
    ];
    public function run()
    {
        foreach ($this->infos as $info) {
            CompanyInfo::create($info);
        }
    }
}
