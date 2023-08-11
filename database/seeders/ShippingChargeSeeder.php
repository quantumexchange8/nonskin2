<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ShippingCharge;

class ShippingChargeSeeder extends Seeder
{
    public $shipping_charges = [
        [
            'name' => 'Johor',
            'amount' => 0,
        ],
        [
            'name' => 'Kedah',
            'amount' => 0,
        ],
        [
            'name' => 'Kelantan',
            'amount' => 0,
        ],
        [
            'name' => 'Melaka',
            'amount' => 0,
        ],
        [
            'name' => 'Negeri Sembilan',
            'amount' => 0,
        ],
        [
            'name' => 'Pahang',
            'amount' => 0,
        ],
        [
            'name' => 'Pulau Pinang',
            'amount' => 0,
        ],
        [
            'name' => 'Perak',
            'amount' => 0,
        ],
        [
            'name' => 'Sabah',
            'amount' => 5,
        ],
        [
            'name' => 'Sarawak',
            'amount' => 5,
        ],
        [
            'name' => 'Selangor',
            'amount' => 0,
        ],
        [
            'name' => 'Terengganu',
            'amount' => 0,
        ],
        [
            'name' => 'WP Kuala Lumpur',
            'amount' => 0,
        ],
        [
            'name' => 'WP Labuan',
            'amount' => 0,
        ],
    ];

    public function run()
    {
        foreach ($this->shipping_charges as $shipping_charge) {
            ShippingCharge::create($shipping_charge);
        }
    }
}
