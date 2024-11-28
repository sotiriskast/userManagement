<?php
namespace App\Services;
use App\Models\Customer;
use App\Repositories\Contracts\CustomerRepositoryInterface;

class CustomerService
{
    protected CustomerRepositoryInterface $customerRepositoryInterface;

    public function __construct(CustomerRepositoryInterface $customerRepositoryInterface)
    {
        $this->customerRepositoryInterface = $customerRepositoryInterface;
    }
    public function searchCustomers($filters, $perPage = 10)

    {
        return $this->customerRepositoryInterface->search($filters, $perPage);
    }
    public function getAllCustomers()
    {
        return $this->customerRepositoryInterface->getAll();
    }

    public function getCustomerById($id)
    {
        return $this->customerRepositoryInterface->findById($id);
    }

    public function createCustomer(array $data): Customer
    {
        return $this->customerRepositoryInterface->create($data);
    }

    public function updateCustomer(Customer $customer, array $data): Customer
    {
        return $this->customerRepositoryInterface->update($customer, $data);
    }

    public function deleteCustomer(Customer $customer): void
    {
        $this->customerRepositoryInterface->delete($customer);
    }
    public function getAllPaginatedCustomers($perPage = 10)
    {
        return $this->customerRepositoryInterface->getAllPaginated($perPage);
    }
}

