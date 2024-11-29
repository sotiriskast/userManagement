<?php
namespace Tests\Feature;

use App\Models\Customer;
use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CustomerManagementTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_create_customer(): void
    {
        $admin = User::factory()->create();
        $admin->roles()->attach(Role::where('name', 'admin')->first());

        $this->actingAs($admin)
            ->post(route('customers.store'), [
                'name' => 'Jane Doe',
                'email' => 'jane@example.com',
                'ip_address' => '127.0.0.1',
                'country' => 'USA',
            ])
            ->assertRedirect(route('customers.index'))
            ->assertSessionHas('success', 'Customer created successfully.');

        $this->assertDatabaseHas('customers', ['email' => 'jane@example.com']);
    }

    public function test_regular_user_cannot_create_customer(): void
    {
        $user = User::factory()->create();
        $user->roles()->attach(Role::where('name', 'user')->first());

        $this->actingAs($user)
            ->post(route('customers.store'), [
                'name' => 'Jane Doe',
                'email' => 'jane@example.com',
                'ip_address' => '127.0.0.1',
                'country' => 'USA',
            ])
            ->assertForbidden();
    }
}
