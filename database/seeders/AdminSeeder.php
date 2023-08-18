<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Cart;
use App\Models\Address;
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
            'upline_id'         => null,
            'full_name'         => 'default',
            'username'          => 'default',
            'id_no'             => '111111011111',
            'contact'           => '01111111111',
            'email'             => 'default@currenttech',
            'bank_name'         =>'Maybank',
            'bank_holder_name'  =>'default',
            'bank_acc_no'       =>'1111111111',
            'bank_ic'           =>'111111011111',
            'avatar'            => null,
            'password'          => Hash::make('defaultsecret'),
            'role'              => 'default',
            'address_1'         =>'VO6-03-08, Signature 2,',
            'address_2'         => 'Lingkaran SV, Sunway Velocity',
            'postcode'          => '55100',
            'city'              => 'Cheras',
            'state'             => 'WP Kuala Lumpur',
            'country'           => 'Malaysia',
            'created_at'        =>  NOW(),
            'updated_at'        => NOW(),
            'delivery_address_1' => 'home address1',
            'delivery_address_2' => 'home address2',
            'delivery_city' => 'city',
            'delivery_postcode' => '12345',
            'delivery_state' => 'KL',
            'delivery_country' => 'my',
        ])->assignRole  ('default', 'superadmin');

        Address::create([
            'user_id'       => 1,
            'name'          => 'default',
            'contact'       => '01111111111',
            'is_default'    => 1,
            'address_1'     => 'VO6-03-08, Signature 2,',
            'address_2'     => 'Lingkaran SV, Sunway Velocity',
            'postcode'      => '55100',
            'city'          => 'Cheras',
            'state'         => 'WP Kuala Lumpur',
            'country'       => 'Malaysia',
            'updated_at'    => null,
            'created_by'    => 1
        ]);

        User::create(
        [
            'upline_id'         => null,
            'full_name'         => 'Superadmin',
            'username'          => 'Superadmin',
            'id_no'             => '111111021111',
            'contact'           => '01211111111',
            'email'             => 'superadmin@currenttech',
            'bank_name'         => 'Maybank',
            'bank_holder_name'  => 'Superadmin',
            'bank_acc_no'       => '1111111112',
            'bank_ic'           => '111111021111',
            'avatar'            => null,
            'password'          => Hash::make('secret'),
            'role'              => 'superadmin',
            'address_1'         => 'VO6-03-08, Signature 2,',
            'address_2'         => 'Lingkaran SV, Sunway Velocity',
            'postcode'          => '55100',
            'city'              => 'Cheras',
            'state'             => 'WP Kuala Lumpur',
            'country'           => 'Malaysia',
            'created_at'        => NOW(),
            'updated_at'        => NOW(),
            'rank_id'           =>  null,
            'delivery_address_1' => 'home address1',
            'delivery_address_2' => 'home address2',
            'delivery_city' => 'city',
            'delivery_postcode' => '12345',
            'delivery_state' => 'KL',
            'delivery_country' => 'my',
        ])->assignRole('superadmin');

        Address::create([
            'user_id'       => 2,
            'name'          => 'Superadmin',
            'contact'       => '01211111111',
            'is_default'    => 1,
            'address_1'     => 'VO6-03-08, Signature 2,',
            'address_2'     => 'Lingkaran SV, Sunway Velocity',
            'postcode'      => '55100',
            'city'          => 'Cheras',
            'state'         => 'WP Kuala Lumpur',
            'country'       => 'Malaysia',
            'updated_at'    => null,
            'created_by'    => 1
        ]);

        User::create(
        [
            'referrer_id'       => 'NON000000001',
            'full_name'         => 'Admin',
            'username'          => 'Admin',
            'id_no'             => '111111031111',
            'contact'           => '60105635811',
            'email'             => 'admin@nonskin',
            'bank_name'         => 'Maybank',
            'bank_holder_name'  => 'Admin',
            'bank_acc_no'       => '1111111113',
            'bank_ic'           => '111111031111',
            'avatar'            => null,
            'password'          => Hash::make('admin'),
            'role'              => 'admin',
            'address_1'         => 'A-GF-07 Sky Park @ One City',
            'address_2'         => 'Jalan USJ25/1',
            'postcode'          => '47650',
            'city'              => 'Subang Jaya',
            'state'             => 'Selangor',
            'country'           => 'Malaysia',
            'created_at'        => NOW(),
            'updated_at'        => NOW(),
            'rank_id'           =>  null,
            'delivery_address_1' => 'home address1',
            'delivery_address_2' => 'home address2',
            'delivery_city' => 'city',
            'delivery_postcode' => '12345',
            'delivery_state' => 'KL',
            'delivery_country' => 'my',
        ])->assignRole('admin');

        Address::create([
            'user_id'       => 3,
            'name'          => 'Admin',
            'contact'       => '60105635811',
            'is_default'    => 1,
            'address_1'     => 'A-GF-07 Sky Park @ One City',
            'address_2'     => 'Jalan USJ25/1',
            'postcode'      => '47650',
            'city'          => 'Subang Jaya',
            'state'         => 'Selangor',
            'country'       => 'Malaysia',
            'updated_at'    => null,
            'created_by'    => 1
        ]);

        User::create(
        [
            'purchase_wallet'   => 30000,
            'cash_wallet'       => 10000,
            'product_wallet'    => 1000,
            'upline_id'         => 3,
            'hierarchyList'     => '-3-',
            'referrer_id'       => 'NON000000002',
            'full_name'         => 'Lee Chong Wei',
            'username'          => 'Chong Wei',
            'id_no'             => '111111041111',
            'contact'           => '01411111111',
            'email'             => 'chief@nonskin',
            'bank_name'         => 'Maybank',
            'bank_holder_name'  => 'Lee Chong Wei',
            'bank_acc_no'       => '1111111114',
            'bank_ic'           => '111111041111',
            'avatar'            => null,
            'password'          => Hash::make('secret'),
            'role'              =>  'user',
            'address_1'         => 'No 4, Jalan Api 4',
            'address_2'         => 'Taman Api',
            'postcode'          => '81300',
            'city'              => 'Johor Bahru',
            'state'             => 'Johor',
            'country'           => 'Malaysia',
            'created_at'        => NOW(),
            'updated_at'        => NOW(),
            'rank_id'           =>  5,
            'delivery_address_1' => 'home address1',
            'delivery_address_2' => 'home address2',
            'delivery_city' => 'city',
            'delivery_postcode' => '12345',
            'delivery_state' => 'KL',
            'delivery_country' => 'my',
        ])->assignRole('user');

        Address::create([
            'user_id'       => 4,
            'name'          => 'Lee Chong Wei',
            'contact'       => '01411111111',
            'is_default'    => 1,
            'address_1'     => 'No 4, Jalan Api 4',
            'address_2'     => 'Taman Api',
            'postcode'      => '81300',
            'city'          => 'Johor Bahru',
            'state'         => 'Johor',
            'country'       => 'Malaysia',
            'updated_at'    => null,
            'created_by'    => 1
        ]);

        Cart::create([
            'user_id'       => 4,
            'updated_at'    => null,
            'created_by'    => 1
        ]);

        User::create(
        [
            'purchase_wallet'   => 30000,
            'cash_wallet'       => 10000,
            'product_wallet'    => 1000,
            'upline_id'         => 3,
            'hierarchyList'     => '-3-',
            'referrer_id'       => 'NON000000003',
            'full_name'         => 'Leonard Hofstadter',
            'username'          => 'Leonard',
            'id_no'             => '111111051111',
            'contact'           => '01511111111',
            'email'             => 'exclusive@nonskin',
            'bank_name'         => 'Maybank',
            'bank_holder_name'  => 'Leonard Hofstadter',
            'bank_acc_no'       => '1111111115',
            'bank_ic'           => '111111051111',
            'avatar'            => null,
            'password'          => Hash::make('secret'),
            'role'              =>  'user',
            'address_1'         => 'No 5, Jalan Api 5',
            'address_2'         => 'Taman Api',
            'postcode'          => '81300',
            'city'              => 'Johor Bahru',
            'state'             => 'Johor',
            'country'           => 'Malaysia',
            'created_at'        => NOW(),
            'updated_at'        => NOW(),
            'rank_id'           =>  4,
            'delivery_address_1' => 'home address1',
            'delivery_address_2' => 'home address2',
            'delivery_city' => 'city',
            'delivery_postcode' => '12345',
            'delivery_state' => 'KL',
            'delivery_country' => 'my',
        ])->assignRole('user');

        Address::create([
            'user_id'       => 5,
            'name'          => 'Leonard Hofstadter',
            'contact'       => '01511111111',
            'is_default'    => 1,
            'address_1'     => 'No 5, Jalan Api 5',
            'address_2'     => 'Taman Api',
            'postcode'      => '81300',
            'city'          => 'Johor Bahru',
            'state'         => 'Johor',
            'country'       => 'Malaysia',
            'updated_at'    => null,
            'created_by'    => 1
        ]);

        Cart::create([
            'user_id'       => 5,
            'updated_at'    => null,
            'created_by'    => 1
        ]);

        User::create(
        [
            'purchase_wallet'   => 30000,
            'cash_wallet'       => 10000,
            'cash_wallet'       => 10000,
            'product_wallet'    => 1000,
            'upline_id'         => 3,
            'hierarchyList'     => '-3-',
            'referrer_id'       => 'NON000000004',
            'full_name'         => 'Ali Ah Kau',
            'username'          => 'Ali',
            'id_no'             => '111111061111',
            'contact'           => '01611111111',
            'email'             => 'general@nonskin',
            'bank_name'         => 'Maybank',
            'bank_holder_name'  => 'Ali Ah Kau',
            'bank_acc_no'       => '1111111116',
            'bank_ic'           => '111111061111',
            'avatar'            => null,
            'password'          => Hash::make('secret'),
            'role'              =>  'user',
            'address_1'         => 'No 6, Jalan Api 6',
            'address_2'         => 'Taman Api',
            'postcode'          => '81300',
            'city'              => 'Johor Bahru',
            'state'             => 'Johor',
            'country'           => 'Malaysia',
            'created_at'        => NOW(),
            'updated_at'        => NOW(),
            'rank_id'           =>  3,
            'delivery_address_1' => 'home address1',
            'delivery_address_2' => 'home address2',
            'delivery_city' => 'city',
            'delivery_postcode' => '12345',
            'delivery_state' => 'KL',
            'delivery_country' => 'my',
        ])->assignRole('user');

        Address::create([
            'user_id'       => 6,
            'name'          => 'Ali Ah Kau',
            'contact'       => '01611111111',
            'is_default'    => 1,
            'address_1'     => 'No 6, Jalan Api 6',
            'address_2'     => 'Taman Api',
            'postcode'      => '81300',
            'city'          => 'Johor Bahru',
            'state'         => 'Johor',
            'country'       => 'Malaysia',
            'updated_at'    => null,
            'created_by'    => 1
        ]);

        Cart::create([
            'user_id'       => 6,
            'updated_at'    => null,
            'created_by'    => 1
        ]);

        User::create(
        [
            'purchase_wallet'   => 30000,
            'cash_wallet'       => 10000,
            'product_wallet'    => 1000,
            'upline_id'         => 5,
            'hierarchyList'     => '-5-',
            'referrer_id'       => 'NON000000005',
            'full_name'         => 'Tiong Wan Chuah',
            'username'          => 'Syazwan',
            'id_no'             => '111111071111',
            'contact'           => '01711111111',
            'email'             => 'member@nonskin',
            'bank_name'         => 'Maybank',
            'bank_holder_name'  => 'Tiong Wan Chuah',
            'bank_acc_no'       => '1111111117',
            'bank_ic'           => '111111071111',
            'avatar'            => null,
            'password'          => Hash::make('secret'),
            'role'              =>  'user',
            'address_1'         => '31, Jalan Tuaran Batu 5',
            'postcode'          => '88450',
            'city'              => 'Kota Kinabalu',
            'state'             => 'Sabah',
            'country'           => 'Malaysia',
            'created_at'        => NOW(),
            'updated_at'        => NOW(),
            'rank_id'           =>  2,
            'delivery_address_1' => 'home address1',
            'delivery_address_2' => 'home address2',
            'delivery_city' => 'city',
            'delivery_postcode' => '12345',
            'delivery_state' => 'KL',
            'delivery_country' => 'my',
        ])->assignRole('user');

        Address::create(
        [
        'user_id'       => 7,
        'name'          => 'Tiong Wan Chuah',
        'contact'       => '01711111111',
        'is_default'    => 1,
        'address_1'     => '31, Jalan Tuaran Batu 5',
        'postcode'      => '88450',
        'city'          => 'Kota Kinabalu',
        'state'         => 'Sabah',
        'country'       => 'Malaysia',
        'updated_at'    => null,
        'created_by'    => 1
        ]);

        Address::create(
        [
            'user_id'       => 7,
            'name'          => 'Tiong Char Siew',
            'contact'       => '01711111777',
            'is_default'    => 0,
            'address_1'     => '5, Jalan Naga 5',
            'address_2'     => 'Taman Sri Skudai',
            'postcode'      => '81300',
            'city'          => 'Johor Bahru',
            'state'         => 'Johor',
            'country'       => 'Malaysia',
            'updated_at'    => null,
            'created_by'    => 1
        ]);

        Cart::create([
            'user_id'       => 7,
            'updated_at'    => null,
            'created_by'    => 1
        ]);

        User::create(
        [
            'purchase_wallet'   => 30000,
            'cash_wallet'       => 10000,
            'product_wallet'    => 1000,
            'upline_id'         => 5,
            'hierarchyList'     => '-5-',
            'referrer_id'       => 'NON000000006',
            'full_name'         => 'Lee Yew Eng',
            'username'          => 'Yew',
            'id_no'             => '111111081111',
            'contact'           => '01811111111',
            'email'             => 'client@nonskin',
            'bank_name'         => 'Maybank',
            'bank_holder_name'  => 'Lee Yew Eng',
            'bank_acc_no'       => '1111111118',
            'bank_ic'           => '111111081111',
            'avatar'            => null,
            'password'          => Hash::make('secret'),
            'role'              =>  'user',
            'address_1'         => 'No 8, Jalan Api 8',
            'address_2'         => 'Taman Api',
            'postcode'          => '81300',
            'city'              => 'Johor Bahru',
            'state'             => 'Johor',
            'country'           => 'Malaysia',
            'created_at'        => NOW(),
            'updated_at'        => NOW(),
            'rank_id'           =>  1,
            'delivery_address_1' => 'home address1',
            'delivery_address_2' => 'home address2',
            'delivery_city' => 'city',
            'delivery_postcode' => '12345',
            'delivery_state' => 'KL',
            'delivery_country' => 'my',
        ])->assignRole('user');

        Address::create([
            'user_id'       => 8,
            'name'          => 'Lee Yew Eng',
            'contact'       => '01811111111',
            'is_default'    => 1,
            'address_1'     => 'No 8, Jalan Api 8',
            'address_2'     => 'Taman Api',
            'postcode'      => '81300',
            'city'          => 'Johor Bahru',
            'state'         => 'Johor',
            'country'       => 'Malaysia',
            'updated_at'    => null,
            'created_by'    => 1
        ]);

        Cart::create([
            'user_id'       => 8,
            'updated_at'    => null,
            'created_by'    => 1
        ]);
    }
}
