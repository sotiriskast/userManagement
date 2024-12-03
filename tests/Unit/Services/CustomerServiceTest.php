<?php

namespace Tests\Unit\Services;

use App\Services\CustomerService;
use App\Models\Customer;
use Tests\TestCase;

class CustomerServiceTest extends TestCase
{
    private CustomerService $customerService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->customerService = $this->app->make(CustomerService::class);
    }

    public function test_create_customer_service()
    {
        $customerData = Customer::factory()->make()->toArray();
        $customer = $this->customerService->createCustomer($customerData);

        $this->assertInstanceOf(Customer::class, $customer);
        $this->assertDatabaseHas('customers', [
            'name' => $customerData['name']
        ]);
    }
}
