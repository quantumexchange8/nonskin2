<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Country;

class CountrySeeder extends Seeder
{
    public $countries = [
        [
            'name' => 'Malaysia',
            'updated_at' => null,
            'created_by' => 1
        ],
        [
            'name' => 'Singapore',
            'updated_at' => null,
            'created_by' => 1
        ],
    ];

    public function run()
    {
        foreach ($this->countries as $country) {
            Country::create($country);
        }
    }
}
