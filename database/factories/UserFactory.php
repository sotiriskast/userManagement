<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
            'remember_token' => Str::random(10),
        ];
    }
    public function admin()
    {
        return $this->afterCreating(function (User $user) {
            $user->roles()->attach(Role::where('name', 'admin')->first());
        });
    }

    public function superAdmin()
    {
        return $this->afterCreating(function (User $user) {
            $user->roles()->attach(Role::where('name', 'super_admin')->first());
        });
    }

    public function regularUser()
    {
        return $this->afterCreating(function (User $user) {
            $user->roles()->attach(Role::where('name', 'user')->first());
        });
    }
    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
