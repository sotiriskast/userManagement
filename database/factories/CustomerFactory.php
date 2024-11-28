<?php

namespace Database\Factories;

use App\Models\Country;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Customer>
 */
class CustomerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'client_id' => $this->faker->unique()->uuid,
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'ip_address' => $this->faker->ipv4,
            'country_id' => Country::query()->inRandomOrder()->first()->id,
        ];
    }
}
