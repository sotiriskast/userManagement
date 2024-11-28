<?php

namespace Database\Seeders;

use App\Enums\UserRole;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $superAdminRole = Role::where('name', UserRole::SUPER_ADMIN->value)->first();
        $adminRole = Role::where('name', UserRole::ADMIN->value)->first();
        $userRole = Role::where('name', UserRole::USER->value)->first();

        User::factory()->create([
            'name' => fake()->name(),
            'email' => 'root@root.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10),
        ])->roles()->attach($superAdminRole);

        User::factory()->create([
            'name' => fake()->name(),
            'email' => 'admin@root.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10),

        ])->roles()->attach($adminRole);
        User::factory()->create([
            'name' => fake()->name(),
            'email' => 'user@root.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10),

        ])->roles()->attach($userRole);


    }
}
