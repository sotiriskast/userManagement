<?php

namespace Tests\Feature;
use App\Models\User;
use App\Models\Customer;
use App\Models\Role;
use App\Enums\UserRole;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CustomerTest extends TestCase
{
    use RefreshDatabase;

    private User $admin;
    private User $user;

    protected function setUp(): void
    {
        parent::setUp();

        $adminRole = Role::create(['name' => UserRole::ADMIN->value]);
        $userRole = Role::create(['name' => UserRole::USER->value]);

        $this->admin = User::factory()->create();
        $this->admin->roles()->attach($adminRole);

        $this->user = User::factory()->create();
        $this->user->roles()->attach($userRole);
    }

    public function test_admin_can_view_customers_list()
    {
        $response = $this->actingAs($this->admin)->get(route('customers.index'));
        $response->assertStatus(200);
    }

    public function test_user_can_view_customers_list()
    {
        $response = $this->actingAs($this->user)->get(route('customers.index'));
        $response->assertStatus(200);
    }

    public function test_admin_can_create_customer()
    {
        $customerData = Customer::factory()->make()->toArray();
        $response = $this->actingAs($this->admin)->post(route('customers.store'), $customerData);
        $response->assertRedirect(route('customers.index'));
        $this->assertDatabaseHas('customers', $customerData);
    }

    public function test_user_cannot_create_customer()
    {
        $customerData = Customer::factory()->make()->toArray();
        $response = $this->actingAs($this->user)->post(route('customers.store'), $customerData);
        $response->assertStatus(403);
    }

}
