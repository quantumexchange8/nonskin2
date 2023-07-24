<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\State;

class StateSeeder extends Seeder
{

    public $states = [
        [ 'name' => 'Johor', 'updated_at' => null, 'created_by' => 1],
        [ 'name' => 'Kedah', 'updated_at' => null, 'created_by' => 1],
        [ 'name' => 'Kelantan', 'updated_at' => null, 'created_by' => 1],
        [ 'name' => 'Melaka', 'updated_at' => null, 'created_by' => 1],
        [ 'name' => 'Negeri Sembilan', 'updated_at' => null, 'created_by' => 1],
        [ 'name' => 'Pahang', 'updated_at' => null, 'created_by' => 1],
        [ 'name' => 'Pulau Pinang', 'updated_at' => null, 'created_by' => 1],
        [ 'name' => 'Perak', 'updated_at' => null, 'created_by' => 1],
        [ 'name' => 'Sabah', 'updated_at' => null, 'created_by' => 1],
        [ 'name' => 'Sarawak', 'updated_at' => null, 'created_by' => 1],
        [ 'name' => 'Selangor', 'updated_at' => null, 'created_by' => 1],
        [ 'name' => 'Terengganu', 'updated_at' => null, 'created_by' => 1],
        [ 'name' => 'WP Kuala Lumpur', 'updated_at' => null, 'created_by' => 1],
        [ 'name' => 'WP Labuan', 'updated_at' => null, 'created_by' => 1],
    ];

    public function run()
    {
        foreach ($this->states as $state) {
            State::create($state);
        }
    }
}
