<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            CurrencySeeder::class,
            RoleSeeder::class,
            UserSeeder::class,
            CountrySeeder::class,
            CustomerSeeder::class,
            TransactionSeeder::class,
        ]);
    }
}
