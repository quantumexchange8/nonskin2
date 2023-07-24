<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\BankSetting;

class BankSettingSeeder extends Seeder
{
    public $banks = [
        [
            'name' => 'Maybank',
            'updated_at' => null,
            'created_by' => 1
        ],
        [
            'name' => 'Hong Leong Bank',
            'updated_at' => null,
            'created_by' => 1
        ],
        [
            'name' => 'Bank Islam Malaysia',
            'updated_at' => null,
            'created_by' => 1
        ],
        [
            'name' => 'United Overseas Bank',
            'updated_at' => null,
            'created_by' => 1
        ],
        [
            'name' => 'Bank Muamalat Malaysia Berhad',
            'updated_at' => null,
            'created_by' => 1
        ],
        [
            'name' => 'Bank Rakyat',
            'updated_at' => null,
            'created_by' => 1
        ],
        [
            'name' => 'OCBC Bank (Malaysia) Berhad',
            'updated_at' => null,
            'created_by' => 1
        ],
        [
            'name' => 'RHB Bank',
            'updated_at' => null,
            'created_by' => 1
        ],
        [
            'name' => 'Alliance Bank Malaysia Berhad',
            'updated_at' => null,
            'created_by' => 1
        ],
        [
            'name' => 'HSBC Bank Malaysia Berhad',
            'updated_at' => null,
            'created_by' => 1
        ],
        [
            'name' => 'Citibank Berhad',
            'updated_at' => null,
            'created_by' => 1
        ],
        [
            'name' => 'CIMB Bank',
            'updated_at' => null,
            'created_by' => 1
        ],
        [
            'name' => 'Affin Islamic Bank Berhad',
            'updated_at' => null,
            'created_by' => 1
        ],
        [
            'name' => 'Bank of China (Malaysia)',
            'updated_at' => null,
            'created_by' => 1
        ],
        [
            'name' => 'Public Bank Berhad
            ',
            'updated_at' => null,
            'created_by' => 1
        ],
        [
            'name' => 'AmBank',
            'updated_at' => null,
            'created_by' => 1
        ],
        [
            'name' => 'Affin Bank',
            'updated_at' => null,
            'created_by' => 1
        ],
        [
            'name' => 'Standard Chartered Bank Malaysia Berhad',
            'updated_at' => null,
            'created_by' => 1
        ],
        [
            'name' => 'Bank Simpanan Nasional',
            'updated_at' => null,
            'created_by' => 1
        ],
        [
            'name' => 'HSBC Amanah Malaysia Berhad',
            'updated_at' => null,
            'created_by' => 1
        ],
        [
            'name' => 'Bank of America Malaysia Berhad',
            'updated_at' => null,
            'created_by' => 1
        ],
    ];

    public function run()
    {
        foreach ($this->banks as $bank) {
            BankSetting::create($bank);
        }
    }
}
