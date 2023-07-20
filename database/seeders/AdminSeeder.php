<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Cart;
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
            'username'      =>'default',
            'id_no'         =>'111111011111',
            'contact'       => '01111111111',
            'email'         =>'default@currenttech',
            'address_1'     =>'No 1, Jalan Api 1',
            'address_2'     =>'Taman Api',
            'city'          =>'Johor Bahru',
            'postcode'      =>'81300',
            'state'         =>'Johor',
            'country'       =>'Malaysia',
            'bank_name'         =>'MAYBANK',
            'bank_holder_name'  =>'default',
            'bank_acc_no'       =>'1111111111',
            'bank_ic'           =>'111111011111',
            'delivery_address_1'     =>'No 1, Jalan Api 1',
            'delivery_address_2'     =>'Taman Api',
            'delivery_city'          =>'Johor Bahru',
            'delivery_postcode'      =>'81300',
            'delivery_state'         =>'Johor',
            'delivery_country'       =>'Malaysia',
            'remarks'       => 'testing',
            'avatar'        => '',
            'password'      =>Hash::make('defaultsecret'),
            'role_id'       => 1,
            'role'          => 'default',
            'created_by'    => 1,
            'updated_at' => null,
        ])->assignRole('default', 'superadmin');

        User::create(
        [
            'name'          =>'Superadmin',
            'username'      =>'Superadmin',
            'id_no'         =>'111111021111',
            'contact'       =>'01211111111',
            'email'         =>'superadmin@currenttech',
            'address_1'     =>'No 1, Jalan Api 1',
            'address_2'     =>'Taman Api',
            'city'          =>'Johor Bahru',
            'postcode'      =>'81300',
            'state'         =>'Johor',
            'country'       =>'Malaysia',
            'bank_name'         =>'MAYBANK',
            'bank_holder_name'  =>'Superadmin',
            'bank_acc_no'       =>'1111111112',
            'bank_ic'           =>'111111021111',
            'delivery_address_1'     =>'No 1, Jalan Api 1',
            'delivery_address_2'     =>'Taman Api',
            'delivery_city'          =>'Johor Bahru',
            'delivery_postcode'      =>'81300',
            'delivery_state'         =>'Johor',
            'delivery_country'       =>'Malaysia',
            'remarks'       => 'testing',
            'avatar'        => '',
            'password'      =>Hash::make('secret'),
            'ranking_name'  => 'Superadmin',
            'role_id'       => 2,
            'role'          => 'superadmin',
            'created_by'    => 1,
            'updated_at' => null,
        ])->assignRole('superadmin');

        User::create(
        [
            'name'          =>'Admin',
            'username'      =>'Admin',
            'id_no'         =>'111111031111',
            'contact'       =>'01311111111',
            'email'         =>'admin@nonskin',
            'address_1'     =>'No 1, Jalan Api 1',
            'address_2'     =>'Taman Api',
            'city'          =>'Johor Bahru',
            'postcode'      =>'81300',
            'state'         =>'Johor',
            'country'       =>'Malaysia',
            'bank_name'         =>'MAYBANK',
            'bank_holder_name'  =>'Admin',
            'bank_acc_no'       =>'1111111113',
            'bank_ic'           =>'111111031111',
            'delivery_address_1'     =>'No 1, Jalan Api 1',
            'delivery_address_2'     =>'Taman Api',
            'delivery_city'          =>'Johor Bahru',
            'delivery_postcode'      =>'81300',
            'delivery_state'         =>'Johor',
            'delivery_country'       =>'Malaysia',
            'remarks'       => 'testing',
            'avatar'        => '',
            'password'      =>Hash::make('admin'),
            'ranking_name'  => 'Admin',
            'role_id'       => 3,
            'role'          => 'admin',
            'created_by'    => 1,
            'updated_at' => null,
        ])->assignRole('admin');

        User::create(
        [
            'name'          =>'Lim Guan Eng',
            'username'      =>'Guan',
            'id_no'         =>'111111041111',
            'contact'       =>'01411111111',
            'email'         =>'chief@nonskin',
            'address_1'     =>'No 1, Jalan Api 1',
            'address_2'     =>'Taman Api',
            'city'          =>'Johor Bahru',
            'postcode'      =>'81300',
            'state'         =>'Johor',
            'country'       =>'Malaysia',
            'bank_name'         =>'MAYBANK',
            'bank_holder_name'  =>'Lim Guan Eng',
            'bank_acc_no'       =>'1111111114',
            'bank_ic'           =>'111111041111',
            'delivery_address_1'     =>'No 1, Jalan Api 1',
            'delivery_address_2'     =>'Taman Api',
            'delivery_city'          =>'Johor Bahru',
            'delivery_postcode'      =>'81300',
            'delivery_state'         =>'Johor',
            'delivery_country'       =>'Malaysia',
            'remarks'       => 'testing',
            'avatar'        => '',
            'password'      =>Hash::make('secret'),
            'ranking_id'    => 1,
            'ranking_name'  => 'Chief Distributor',
            'role_id'       => 4,
            'role'          => 'user',
            'created_by'    => 1,
            'updated_at' => null,
        ])->assignRole('user');
        Cart::create([
            'user_id' => 4,
            'updated_at' => null,
            'created_by' => 1
        ]);

        User::create(
        [
            'name'          =>'Lim Kit Siang',
            'username'      =>'Kit',
            'id_no'         =>'111111051111',
            'contact'       =>'01511111111',
            'email'         =>'exclusive@nonskin',
            'address_1'     =>'No 1, Jalan Api 1',
            'address_2'     =>'Taman Api',
            'city'          =>'Johor Bahru',
            'postcode'      =>'81300',
            'state'         =>'Johor',
            'country'       =>'Malaysia',
            'bank_name'         =>'MAYBANK',
            'bank_holder_name'  =>'Lim Kit Siang',
            'bank_acc_no'       =>'1111111115',
            'bank_ic'           =>'111111051111',
            'delivery_address_1'     =>'No 1, Jalan Api 1',
            'delivery_address_2'     =>'Taman Api',
            'delivery_city'          =>'Johor Bahru',
            'delivery_postcode'      =>'81300',
            'delivery_state'         =>'Johor',
            'delivery_country'       =>'Malaysia',
            'remarks'       => 'testing',
            'avatar'        => '',
            'password'      =>Hash::make('secret'),
            'ranking_id'    => 2,
            'ranking_name'  => 'Exclusive Distributor',
            'role_id'       => 4,
            'role'          => 'user',
            'created_by'    => 1,
            'updated_at' => null,
        ])->assignRole('user');
        Cart::create([
            'user_id' => 5,
            'updated_at' => null,
            'created_by' => 1
        ]);

        User::create(
        [
            'name'          =>'Ali Ah Kau',
            'username'      =>'Ali',
            'id_no'         =>'111111061111',
            'contact'       =>'01611111111',
            'email'         =>'general@nonskin',
            'address_1'     =>'No 1, Jalan Api 1',
            'address_2'     =>'Taman Api',
            'city'          =>'Johor Bahru',
            'postcode'      =>'81300',
            'state'         =>'Johor',
            'country'       =>'Malaysia',
            'bank_name'         =>'MAYBANK',
            'bank_holder_name'  =>'Ali Ah Kau',
            'bank_acc_no'       =>'1111111116',
            'bank_ic'           =>'111111061111',
            'delivery_address_1'     =>'No 1, Jalan Api 1',
            'delivery_address_2'     =>'Taman Api',
            'delivery_city'          =>'Johor Bahru',
            'delivery_postcode'      =>'81300',
            'delivery_state'         =>'Johor',
            'delivery_country'       =>'Malaysia',
            'remarks'       => 'testing',
            'avatar'        => '',
            'password'      =>Hash::make('secret'),
            'ranking_id'    => 3,
            'ranking_name'  => 'General Distributor',
            'role_id'       => 4,
            'role'          => 'user',
            'created_by'    => 1,
            'updated_at' => null,
        ])->assignRole('user');
        Cart::create([
            'user_id' => 6,
            'updated_at' => null,
            'created_by' => 1
        ]);

        User::create(
        [
            'name'          =>'Tiong Wan Chuah',
            'username'      =>'Syazwan',
            'id_no'         =>'111111071111',
            'contact'       =>'01711111111',
            'email'         =>'member@nonskin',
            'address_1'     =>'No 1, Jalan Api 1',
            'address_2'     =>'Taman Api',
            'city'          =>'Johor Bahru',
            'postcode'      =>'81300',
            'state'         =>'Johor',
            'country'       =>'Malaysia',
            'bank_name'         =>'MAYBANK',
            'bank_holder_name'  =>'Tiong Wan Chuah',
            'bank_acc_no'       =>'1111111117',
            'bank_ic'           =>'111111071111',
            'delivery_address_1'     =>'No 1, Jalan Api 1',
            'delivery_address_2'     =>'Taman Api',
            'delivery_city'          =>'Johor Bahru',
            'delivery_postcode'      =>'81300',
            'delivery_state'         =>'Johor',
            'delivery_country'       =>'Malaysia',
            'remarks'       => 'testing',
            'avatar'        => '',
            'password'      =>Hash::make('secret'),
            'ranking_id'    => 4,
            'ranking_name'  => 'Member',
            'role_id'       => 4,
            'role'          => 'user',
            'created_by'    => 1,
            'updated_at' => null,
        ])->assignRole('user');
        Cart::create([
            'user_id' => 7,
            'updated_at' => null,
            'created_by' => 1
        ]);

        User::create(
        [
            'name'          =>'Lee Yew Eng',
            'username'      =>'Yew',
            'id_no'         =>'111111081111',
            'contact'       =>'01811111111',
            'email'         =>'nonmember@nonskin',
            'address_1'     =>'No 1, Jalan Api 1',
            'address_2'     =>'Taman Api',
            'city'          =>'Johor Bahru',
            'postcode'      =>'81300',
            'state'         =>'Johor',
            'country'       =>'Malaysia',
            'bank_name'         =>'MAYBANK',
            'bank_holder_name'  =>'Lee Yew Eng',
            'bank_acc_no'       =>'1111111118',
            'bank_ic'           =>'111111081111',
            'delivery_address_1'     =>'No 1, Jalan Api 1',
            'delivery_address_2'     =>'Taman Api',
            'delivery_city'          =>'Johor Bahru',
            'delivery_postcode'      =>'81300',
            'delivery_state'         =>'Johor',
            'delivery_country'       =>'Malaysia',
            'remarks'       => 'testing',
            'avatar'        => '',
            'password'      =>Hash::make('secret'),
            'ranking_id'    => 5,
            'ranking_name'  => 'Nonmember',
            'role_id'       => 4,
            'role'          => 'user',
            'created_by'    => 1,
            'updated_at' => null,
        ])->assignRole('user');
        Cart::create([
            'user_id' => 8,
            'updated_at' => null,
            'created_by' => 1
        ]);
    }
}
