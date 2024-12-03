<?php
// tests/Feature/CustomerControllerTest.php
namespace Tests\Feature;

use App\Enums\UserRole;
use App\Models\User;
use App\Models\Customer;
use App\Models\Role;
use Tests\TestCase;

class CustomerControllerTest extends TestCase
{
    public function test_admin_can_access_customer_index()
    {
        $role = Role::where('name', UserRole::ADMIN->value)->first();
        $admin = User::factory()->create();
        $admin->roles()->attach($role);

        $response = $this->actingAs($admin)->get(route('customers.index'));
        $response->assertStatus(200);
    }

    public function test_create_customer_with_valid_data()
    {
        $role = Role::where('name', UserRole::ADMIN->value)->first();
        $admin = User::factory()->create();
        $admin->roles()->attach($role);
        $customerData = Customer::factory()->make()->toArray();

        $response = $this->actingAs($admin)->post(route('customers.store'), $customerData);
        $response->assertRedirect(route('customers.index'));
        $this->assertDatabaseHas('customers', [
            'name' => $customerData['name'],
            'email' => $customerData['email']
        ]);
    }
}
