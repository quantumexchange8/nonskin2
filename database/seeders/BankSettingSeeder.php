<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\BankSetting;

class BankSettingSeeder extends Seeder
{
    public $banks = [
        [
            'name' => 'Maybank',
            'created_by' => 1,
        ],
        [
            'name' => 'Hong Leong Bank',
            'created_by' => 1,
        ],
        [
            'name' => 'Bank Islam Malaysia',
            'created_by' => 1,
        ],
        [
            'name' => 'United Overseas Bank',
            'created_by' => 1,
        ],
        [
            'name' => 'Bank Muamalat Malaysia Berhad',
            'created_by' => 1,
        ],
        [
            'name' => 'Bank Rakyat',
            'created_by' => 1,
        ],
        [
            'name' => 'OCBC Bank (Malaysia) Berhad',
            'created_by' => 1,
        ],
        [
            'name' => 'RHB Bank',
            'created_by' => 1,
        ],
        [
            'name' => 'Alliance Bank Malaysia Berhad',
            'created_by' => 1,
        ],
        [
            'name' => 'HSBC Bank Malaysia Berhad',
            'created_by' => 1,
        ],
        [
            'name' => 'Citibank Berhad',
            'created_by' => 1,
        ],
        [
            'name' => 'CIMB Bank',
            'created_by' => 1,
        ],
        [
            'name' => 'Affin Islamic Bank Berhad',
            'created_by' => 1,
        ],
        [
            'name' => 'Bank of China (Malaysia)',
            'created_by' => 1,
        ],
        [
            'name' => 'Public Bank Berhad
            ',
            'created_by' => 1,
        ],
        [
            'name' => 'AmBank',
            'created_by' => 1,
        ],
        [
            'name' => 'Affin Bank',
            'created_by' => 1,
        ],
        [
            'name' => 'Standard Chartered Bank Malaysia Berhad',
            'created_by' => 1,
        ],
        [
            'name' => 'Bank Simpanan Nasional',
            'created_by' => 1,
        ],
        [
            'name' => 'HSBC Amanah Malaysia Berhad',
            'created_by' => 1,
        ],
        [
            'name' => 'Bank of America Malaysia Berhad',
            'created_by' => 1,
        ],
    ];

    public function run()
    {
        foreach ($this->banks as $bank) {
            BankSetting::create($bank);
        }
    }
}
