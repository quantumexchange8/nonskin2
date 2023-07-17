<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create(
        [
            'name'          =>'default',
            'contact'       => null,
            'email'         =>'default@currenttech',
            'avatar'        => '',
            'password'      =>Hash::make('defaultsecret'),
            'role_id'       => 1,
            'role'          => 'default',
            'created_by'    => 1,
            'updated_by'    => 1,
        ])->assignRole('default', 'superadmin');

        User::create(
        [
            'name'          =>'Superadmin',
            'contact'       =>null,
            'email'         =>'superadmin@currenttech',
            'avatar'        => '',
            'password'      =>Hash::make('secret'),
            'ranking_name'  => 'Superadmin',
            'role_id'       => 2,
            'role'          => 'superadmin',
            'created_by'    => 1,
            'updated_by'    => 1,
        ])->assignRole('superadmin');

        User::create(
        [
            'name'          =>'Admin',
            'contact'       =>null,
            'email'         =>'admin@nonskin',
            'avatar'        => '',
            'password'      =>Hash::make('admin'),
            'ranking_name'  => 'Admin',
            'role_id'       => 3,
            'role'          => 'admin',
            'created_by'    => 1,
            'updated_by'    => 1,
        ])->assignRole('admin');

        User::create(
        [
            'name'          =>'Chief Distributor',
            'contact'       =>'01122223333',
            'email'         =>'chief@nonskin',
            'avatar'        => '',
            'password'      =>Hash::make('secret'),
            'ranking_id'    => 1,
            'ranking_name'  => 'Chief Distributor',
            'role_id'       => 4,
            'role'          => 'user',
            'created_by'    => 1,
            'updated_by'    => 1,
        ])->assignRole('user');

        User::create(
        [
            'name'          =>'Exclusive Distributor',
            'contact'       =>'0108888777',
            'email'         =>'exclusive@nonskin',
            'avatar'        => '',
            'password'      =>Hash::make('secret'),
            'ranking_id'    => 2,
            'ranking_name'  => 'Exclusive Distributor',
            'role_id'       => 4,
            'role'          => 'user',
            'created_by'    => 1,
            'updated_by'    => 1,
        ])->assignRole('user');

        User::create(
        [
            'name'          =>'General Distributor',
            'contact'       =>'0116668888',
            'email'         =>'general@nonskin',
            'avatar'        => '',
            'password'      =>Hash::make('secret'),
            'ranking_id'    => 3,
            'ranking_name'  => 'General Distributor',
            'role_id'       => 4,
            'role'          => 'user',
            'created_by'    => 1,
            'updated_by'    => 1,
        ])->assignRole('user');

        User::create(
        [
            'name'          =>'Member',
            'contact'       =>'01055668989',
            'email'         =>'member@nonskin',
            'avatar'        => '',
            'password'      =>Hash::make('secret'),
            'ranking_id'    => 4,
            'ranking_name'  => 'Member',
            'role_id'       => 4,
            'role'          => 'user',
            'created_by'    => 1,
            'updated_by'    => 1,
        ])->assignRole('user');

        User::create(
        [
            'name'          =>'User',
            'contact'       =>'01147478888',
            'email'         =>'nonmember@nonskin',
            'avatar'        => '',
            'password'      =>Hash::make('secret'),
            'ranking_id'    => 5,
            'ranking_name'  => 'Nonmember',
            'role_id'       => 4,
            'role'          => 'user',
            'created_by'    => 1,
            'updated_by'    => 1,
        ])->assignRole('user');
    }
}
