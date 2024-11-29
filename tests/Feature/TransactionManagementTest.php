<?php
namespace Tests\Feature;

use App\Models\Customer;
use App\Models\Role;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TransactionManagementTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_create_transaction(): void
    {
        $admin = User::factory()->create();
        $admin->roles()->attach(Role::where('name', 'admin')->first());

        $customer = Customer::factory()->create();

        $this->actingAs($admin)
            ->post(route('transactions.store'), [
                'customer_id' => $customer->id,
                'amount' => 150.75,
                'currency_id' => 1, // Assuming this corresponds to a valid currency
                'transaction_date' => now()->toDateString(),
            ])
            ->assertRedirect(route('transactions.index'))
            ->assertSessionHas('success', 'Transaction created successfully.');

        $this->assertDatabaseHas('transactions', ['amount' => 150.75]);
    }

    public function test_user_cannot_create_transaction(): void
    {
        $user = User::factory()->create();
        $user->roles()->attach(Role::where('name', 'user')->first());

        $customer = Customer::factory()->create();

        $this->actingAs($user)
            ->post(route('transactions.store'), [
                'customer_id' => $customer->id,
                'amount' => 150.75,
                'currency_id' => 1,
                'transaction_date' => now()->toDateString(),
            ])
            ->assertForbidden();
    }
}
