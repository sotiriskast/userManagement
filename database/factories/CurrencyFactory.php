<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Currency>
 */
class CurrencyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $currencies = [
            ['code' => 'USD', 'name' => 'United States Dollar'],
            ['code' => 'EUR', 'name' => 'Euro'],
            ['code' => 'GBP', 'name' => 'British Pound'],
            ['code' => 'JPY', 'name' => 'Japanese Yen'],
            ['code' => 'AUD', 'name' => 'Australian Dollar'],
        ];
        $currency = $this->faker->randomElement($currencies);
        return [
            'code' => $currency['code'],
            'name' => $currency['name'],
        ];
    }
}
