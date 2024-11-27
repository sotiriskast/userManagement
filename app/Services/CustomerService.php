<?php
namespace App\Services;
use App\Models\Customer;
use App\Repositories\CustomerRepository;

class CustomerService
{
    protected $customerRepository;

    public function __construct(CustomerRepository $customerRepository)
    {
        $this->customerRepository = $customerRepository;
    }

    public function getAllCustomers()
    {
        return $this->customerRepository->getAll();
    }

    public function getCustomerById($id)
    {
        return $this->customerRepository->findById($id);
    }

    public function createCustomer(array $data)
    {
        return $this->customerRepository->create($data);
    }

    public function updateCustomer(Customer $customer, array $data)
    {
        return $this->customerRepository->update($customer, $data);
    }

    public function deleteCustomer(Customer $customer)
    {
        $this->customerRepository->delete($customer);
    }
}

