<?php

namespace Tests\Unit\Models;

use App\Models\Currency;
use App\Models\Customer;
use App\Models\Country;
use App\Models\Role;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ModelTest extends TestCase
{
    use RefreshDatabase;

    public function test_country_model_relationships()
    {
        $country = Country::factory()->create();
        $customer = Customer::factory()->create(['country_id' => $country->id]);
        $this->assertInstanceOf(Country::class, $customer->country);
        $this->assertTrue($country->customers->contains($customer));
    }

    public function test_customer_model_relationships()
    {
        $customer = Customer::factory()->create();
        $transaction = Transaction::factory()->create(['customer_id' => $customer->id]);

        $this->assertInstanceOf(Customer::class, $transaction->customer);
        $this->assertTrue($customer->transactions->contains($transaction));
    }

    public function test_customer_client_id_generation()
    {
        $customer = Customer::factory()->create();

        $this->assertNotNull($customer->client_id);
        $this->assertTrue(preg_match('/^[0-9a-f]{8}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{12}$/', $customer->client_id) === 1);
    }

    public function test_transaction_model_relationships()
    {
        $customer = Customer::factory()->create();
        $currency = Currency::query()->firstOrCreate(['code' => 'USD', 'name' => 'United States Dollar']);
        $transaction = Transaction::factory()->create([
            'customer_id' => $customer->id,
            'currency_id' => $currency->id,
        ]);
        $this->assertInstanceOf(Customer::class, $transaction->customer);
        $this->assertEquals($customer->id, $transaction->customer->id);

        $this->assertInstanceOf(Currency::class, $transaction->currency);
    }

    public function test_user_model_roles()
    {
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $user = User::factory()->create();
        $user->roles()->attach($adminRole);

        $this->assertTrue($user->hasRole('admin'));
        $this->assertFalse($user->hasRole('super_admin'));
        $this->assertTrue($user->roles->contains($adminRole));
    }

    public function test_role_model_relationships()
    {
        $role = Role::firstOrCreate(['name' => 'admin']);
        $user = User::factory()->create();
        $user->roles()->attach($role);

        $this->assertTrue($role->users->contains($user));
    }
}
