<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call([
            PrefixSeeder::class,
            RoleSeeder::class,
            RankingsSeeder::class,
            CategorySeeder::class,
            ProductSeeder::class,
            ShippingChargeSeeder::class,
            CountrySeeder::class,
            StateSeeder::class,
            BankSettingSeeder::class,
            ShippingSettingSeeder::class,
            PaymentStatusSeeder::class,
            CompanyInfoSeeder::class,
            UsersSeeder::class,
            // AdminSeeder::class,
        ]);

    }
}
