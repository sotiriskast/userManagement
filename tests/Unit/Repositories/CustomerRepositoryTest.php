<?php

namespace Tests\Unit\Repositories;

use App\Models\Customer;
use App\Repositories\CustomerRepository;
use Tests\TestCase;

class CustomerRepositoryTest extends TestCase
{
    private CustomerRepository $customerRepository;

    protected function setUp(): void
    {
        parent::setUp();
        $this->customerRepository = $this->app->make(CustomerRepository::class);
    }

    public function test_create_customer()
    {
        $customerData = Customer::factory()->make()->toArray();
        $customer = $this->customerRepository->create($customerData);

        $this->assertDatabaseHas('customers', [
            'name' => $customerData['name'],
            'email' => $customerData['email']
        ]);
    }

    public function test_search_customers_with_filters()
    {
        Customer::factory()->count(10)->create();

        $filters = ['search' => Customer::first()->name];
        $results = $this->customerRepository->search($filters);

        $this->assertTrue($results->count() > 0);
    }
}
