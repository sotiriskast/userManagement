<?php
namespace Tests\Unit\Models;

use App\Models\Customer;
use App\Models\Country;
use App\Models\Transaction;
use Tests\TestCase;

class CustomerTest extends TestCase
{
    public function test_customer_has_country_relationship()
    {
        $customer = Customer::factory()->create();
        $this->assertInstanceOf(Country::class, $customer->country);
    }

    public function test_customer_has_transactions_relationship()
    {
        $customer = Customer::factory()->create();
        $transaction = Transaction::factory()->create(['customer_id' => $customer->id]);

        $this->assertTrue($customer->transactions->contains($transaction));
    }

    public function test_client_id_is_generated_automatically()
    {
        $customer = Customer::factory()->create();
        $this->assertNotNull($customer->client_id);
        $this->assertTrue(strlen($customer->client_id) > 0);
    }
}
