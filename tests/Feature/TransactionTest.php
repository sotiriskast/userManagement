<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Transaction;
use App\Models\Role;
use App\Enums\UserRole;

class TransactionTest extends TestCase
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

    public function test_admin_can_view_transactions_list()
    {
        $response = $this->actingAs($this->admin)->get(route('transactions.index'));
        $response->assertStatus(200);
    }

    public function test_user_can_view_transactions_list()
    {
        $response = $this->actingAs($this->user)->get(route('transactions.index'));
        $response->assertStatus(200);
    }

    public function test_admin_can_create_transaction()
    {
        $transactionData = Transaction::factory()->make()->toArray();
        $response = $this->actingAs($this->admin)->post(route('transactions.store'), $transactionData);
        $response->assertRedirect(route('transactions.index'));
        $this->assertDatabaseHas('transactions', $transactionData);
    }

    public function test_user_cannot_create_transaction()
    {
        $transactionData = Transaction::factory()->make()->toArray();
        $response = $this->actingAs($this->user)->post(route('transactions.store'), $transactionData);
        $response->assertStatus(403);
    }
}
