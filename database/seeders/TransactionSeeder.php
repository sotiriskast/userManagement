<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\Transaction;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Customer::all()->each(function ($customer) {
            Transaction::factory(rand(1, 5))->create([
                'customer_id' => $customer->id,
            ]);
        });
    }
}
