<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = Role::create(['name' => 'default']);
        $role = Role::create(['name' => 'superadmin']);
        $role = Role::create(['name' => 'admin']);
        $role = Role::create(['name' => 'user']);
        // $role = Role::create(['name' => 'chief']);
        // $role = Role::create(['name' => 'exclusive']);
        // $role = Role::create(['name' => 'general']);
        // $role = Role::create(['name' => 'member']);
        // $role = Role::create(['name' => 'nonmember']);
    }
}
