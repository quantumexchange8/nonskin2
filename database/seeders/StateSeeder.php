<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\State;

class StateSeeder extends Seeder
{
    public $states = [
        [ 'name' => 'Johor', ],
        [ 'name' => 'Kedah', ],
        [ 'name' => 'Kelantan', ],
        [ 'name' => 'Melaka', ],
        [ 'name' => 'Negeri Sembilan', ],
        [ 'name' => 'Pahang', ],
        [ 'name' => 'Pulau Pinang', ],
        [ 'name' => 'Perak', ],
        [ 'name' => 'Sabah', ],
        [ 'name' => 'Sarawak', ],
        [ 'name' => 'Selangor', ],
        [ 'name' => 'Terengganu', ],
        [ 'name' => 'WP Kuala Lumpur', ],
        [ 'name' => 'WP Labuan', ],
    ];

    public function run()
    {
        foreach ($this->states as $state) {
            State::create($state);
        }
    }
}
