<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Address;
use App\Models\Cart;
use League\Csv\Reader;
use League\Csv\Writer;
use League\Csv\Modifier\StreamFilter;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $csv = Reader::createFromPath(base_path() . '/database/csv/users.csv', 'r');
        $csv->setHeaderOffset(0);
        $csv->setDelimiter(',');
        $csv->setEnclosure('"');

        $header = $csv->getHeader(); //returns the CSV header record
        $records = $csv->getRecords(); //returns all the CSV records as an Iterator object
        // dd($records);
        foreach ($records as $user) {
            // dd(trim($user['roles'], " "));
            $new_user = User::create([
                'id'                => $user['id'],
                'upline_id'         => $user['referral'] ?? null,
                'referrer_id'       => $user['referrer'] ?? null,
                'hierarchyList'     => $user['hierarchyList'] ?? null,
                'username'          => $user['username'],
                'email'             => $user['email'],
                'full_name'         => $user['full_name'],
                'id_no'             => $user['id_no'],
                'contact'           => $user['contact'],
                'password'          => Hash::make('Nonskin123456789'),
                'role'              => $user['type'],
                'superadmin'        => $user['superadmin'],
                'member_type'       => $user['member_type'],
                'purchase_wallet'   => 0,
                'cash_wallet'       => 0,
                'product_wallet'    => 0,
                'bonus_quota'       => $user['bonus_quota'],
                'network'           => $user['network'],
                'direct_sponsor'    => $user['direct_sponsor'],
                'daily_sales'       => $user['daily_sales'],
                'personal_sales'    => $user['self_sales'],
                'direct_sales'      => $user['direct_sales'],
                'total_sales'       => $user['total_sales'],
                'group_sales'       => $user['group_sales'],
                'personal_ranking'  => $user['personal_ranking'],

                'address_1'     => $user['address_1'],
                'address_2'     => $user['address_2'],
                'city'          => $user['city'],
                'postcode'      => $user['postcode'],
                'state'         => 'Johor',
                'country'       => 'Malaysia',

                'bank_name' => null,
                'bank_holder_name' => null,
                'bank_acc_no' => null,
                'bank_ic' => null,

                'delivery_address_1'    => $user['address_1'],
                'delivery_address_2'    => $user['address_2'],
                'delivery_city'         => $user['city'],
                'delivery_postcode'     => $user['postcode'],
                'delivery_state'        => 'Johor',
                'delivery_country'      => 'Malaysia',

                'status'        => $user['status'],
                'created_at'    => Carbon::parse($user['created_at']),
                'updated_at'    => Carbon::parse($user['updated_at']),
                'is_active'     => $user['status'] == 1 ? 1 : 0,
                'is_legacy'     => 1,
                'rank_id'       => 1,

            ]);

            $address = Address::create([
                'user_id'       => $user['id'],
                'name'          => $user['full_name'],
                'contact'       => $user['contact'],
                'is_default'    => 1,
                'address_1'     => $user['address_1'],
                'address_2'     => $user['address_2'],
                'city'          => $user['city'],
                'postcode'      => $user['postcode'],
                'state'         => 'Johor',
                'country'       => 'Malaysia',
                'created_by'    => $new_user->id,
                'updated_by'    => $new_user->id,
            ]);

            // check the user role and assign role
            switch ($user['type']) {
                case 'admin':
                    $new_user->rank_id = null;
                    $new_user->save();
                    $new_user->assignRole('admin');
                    break;
                case 'user':
                    $new_user->assignRole('user');
                    break;
            }

            Cart::create([
                'user_id'       => $new_user->id,
                'created_by'    => $new_user->id,
                'updated_by'    => $new_user->id,
                'created_at'    => now(),
                'updated_at'    => now()
            ]);
        }
    }
}
