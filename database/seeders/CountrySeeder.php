<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Country;

class CountrySeeder extends Seeder
{
    public $countries = [
        [
            'name' => 'Malaysia',
        ],
        [
            'name' => 'Singapore',
        ],
    ];

    public function run()
    {
        foreach ($this->countries as $country) {
            Country::create($country);
        }
    }
}
