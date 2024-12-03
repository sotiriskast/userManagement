<?php

namespace Tests\Unit\Policies;

use App\Enums\UserRole;
use App\Models\User;
use App\Models\Customer;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Tests\TestCase;

class CustomerPolicyTest extends TestCase
{
    public function test_admin_can_create_customer()
    {
        $adminRole = Role::where('name', UserRole::ADMIN->value)->first();
        $admin = User::factory()->create();
        $admin->roles()->attach($adminRole);
        $this->actingAs($admin);
        $customer = Customer::factory()->make();

        $this->assertTrue(auth()->user()->can('create', $customer));
    }

    public function test_regular_user_cannot_create_customer()
    {
        $userRole = Role::where('name', UserRole::USER->value)->first();
        $user = User::factory()->create();
        $user->roles()->attach($userRole);
        $this->actingAs($user);
        $customer = Customer::factory()->make();

        $this->assertFalse(auth()->user()->can('create', $customer));
    }
}
