<?php

namespace Database\Factories;

use App\Models\Currency;
use App\Models\Customer;
use App\Models\Transaction;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Transaction>
 */
class TransactionFactory extends Factory
{
    protected $model = Transaction::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'customer_id' => Customer::factory(), // Reference the customer by primary key
            'amount' => $this->faker->randomFloat(2, 10, 1000), // Random float between 10 and 1000
            'currency_id' => Currency::query()->inRandomOrder()->first()->id, // Random currency_id
            'transaction_date' => $this->faker->dateTimeBetween('-1 year', 'now'), // Date within the last year
        ];
    }
}
