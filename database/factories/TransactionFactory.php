<?php

namespace Database\Factories;

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
            'client_id' => Customer::factory(),
            'amount' => $this->faker->randomFloat(2, 10, 1000),
            'currency' => $this->faker->currencyCode,
            'transaction_date' => $this->faker->dateTimeBetween('-1 year', 'now')

        ];
    }
}