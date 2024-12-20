<?php
namespace App\Services;
use App\Models\Customer;
use App\Repositories\CustomerRepository;

class CustomerService
{
    protected CustomerRepository $customerRepository;

    public function __construct(CustomerRepository $customerRepository)
    {
        $this->customerRepository = $customerRepository;
    }
    public function searchCustomers($filters, $perPage = 10)

    {
        return $this->customerRepository->search($filters, $perPage);
    }
    public function getAllCustomers()
    {
        return $this->customerRepository->getAll();
    }

    public function getCustomerById($id)
    {
        return $this->customerRepository->findById($id);
    }

    public function createCustomer(array $data): Customer
    {
        return $this->customerRepository->create($data);
    }

    public function updateCustomer(Customer $customer, array $data): Customer
    {
        return $this->customerRepository->update($customer, $data);
    }

    public function deleteCustomer(Customer $customer): void
    {
        $this->customerRepository->delete($customer);
    }
    public function getAllPaginatedCustomers($perPage = 10)
    {
        return $this->customerRepository->getAllPaginated($perPage);
    }
}

