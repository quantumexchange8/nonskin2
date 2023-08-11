<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\BankSetting;

class BankSettingSeeder extends Seeder
{
    public $banks = [
        [
            'name' => 'Maybank',
        ],
        [
            'name' => 'Hong Leong Bank',
        ],
        [
            'name' => 'Bank Islam Malaysia',
        ],
        [
            'name' => 'United Overseas Bank',
        ],
        [
            'name' => 'Bank Muamalat Malaysia Berhad',
        ],
        [
            'name' => 'Bank Rakyat',
        ],
        [
            'name' => 'OCBC Bank (Malaysia) Berhad',
        ],
        [
            'name' => 'RHB Bank',
        ],
        [
            'name' => 'Alliance Bank Malaysia Berhad',
        ],
        [
            'name' => 'HSBC Bank Malaysia Berhad',
        ],
        [
            'name' => 'Citibank Berhad',
        ],
        [
            'name' => 'CIMB Bank',
        ],
        [
            'name' => 'Affin Islamic Bank Berhad',
        ],
        [
            'name' => 'Bank of China (Malaysia)',
        ],
        [
            'name' => 'Public Bank Berhad
            ',
        ],
        [
            'name' => 'AmBank',
        ],
        [
            'name' => 'Affin Bank',
        ],
        [
            'name' => 'Standard Chartered Bank Malaysia Berhad',
        ],
        [
            'name' => 'Bank Simpanan Nasional',
        ],
        [
            'name' => 'HSBC Amanah Malaysia Berhad',
        ],
        [
            'name' => 'Bank of America Malaysia Berhad',
        ],
    ];

    public function run()
    {
        foreach ($this->banks as $bank) {
            BankSetting::create($bank);
        }
    }
}
