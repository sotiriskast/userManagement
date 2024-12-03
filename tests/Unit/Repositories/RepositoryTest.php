<?php

namespace Tests\Unit\Repositories;

use App\Models\Currency;
use App\Models\Customer;
use App\Models\Role;
use App\Models\Transaction;
use App\Models\User;
use App\Repositories\CustomerRepository;
use App\Repositories\TransactionRepository;
use App\Repositories\UserRepository;
use App\Services\CustomerService;
use App\Services\TransactionService;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RepositoryTest extends TestCase
{
    use RefreshDatabase;

    public function test_customer_service_methods()
    {
        $service = app(CustomerService::class);

        // Create Customer
        $customerData = Customer::factory()->make()->toArray();
        $customer = $service->createCustomer($customerData);
        $this->assertDatabaseHas('customers', $customerData);

        // Get Customer by ID
        $foundCustomer = $service->getCustomerById($customer->id);
        $this->assertEquals($customer->id, $foundCustomer->id);

        // Update Customer
        $updateData = ['name' => 'Updated Customer'];
        $updatedCustomer = $service->updateCustomer($customer, $updateData);
        $this->assertEquals('Updated Customer', $updatedCustomer->name);

        // Delete Customer
        $service->deleteCustomer($customer);
        $this->assertDatabaseMissing('customers', ['id' => $customer->id]);
    }

    public function test_transaction_service_methods()
    {
        $service = app(TransactionService::class);
        $customer = Customer::factory()->create();

        // Create Transaction
        $transactionData = Transaction::factory()->make([
            'customer_id' => $customer->id,
        ])->toArray();

        // Normalize the date format for comparison
        $transactionData['transaction_date'] = Carbon::parse($transactionData['transaction_date'])->format('Y-m-d H:i:s');

        $transaction = $service->createTransaction($transactionData);
        $this->assertDatabaseHas('transactions', $transactionData);

        // Update Transaction
        $updateData = ['amount' => 999.99];
        $updatedTransaction = $service->updateTransaction($transaction, $updateData);
        $this->assertEquals(999.99, $updatedTransaction->amount);

        // Delete Transaction
        $service->deleteTransaction($transaction);
        $this->assertDatabaseMissing('transactions', ['id' => $transaction->id]);
    }

    public function test_transaction_count_by_country()
    {
        $service = app(TransactionService::class);
        Transaction::factory()->count(10)->create();
        $countryCounts = $service->getTransactionCountByCountry();
        $this->assertGreaterThan(0, $countryCounts->count());
        $firstCountryCount = $countryCounts->first();
        $this->assertTrue(property_exists($firstCountryCount, 'country'), 'Country property missing');
        $this->assertTrue(property_exists($firstCountryCount, 'total'), 'Total property missing');
    }
}
