<?php
namespace App\Repositories\Contracts;

use App\Models\Customer;

interface CustomerRepositoryInterface
{
    public function getAll();
    public function findById(int $id): ?Customer;
    public function create(array $data): Customer;
    public function update(Customer $customer, array $data): Customer;
    public function delete(Customer $customer): void;
    public function search(string $keyword, int $perPage = 10);
}
