<?php
namespace App\Repositories;
use App\Models\Customer;

class CustomerRepository
{
    public function getAll()
    {
        return Customer::all();
    }

    public function findById($id)
    {
        return Customer::findOrFail($id);
    }

    public function create(array $data)
    {
        return Customer::create($data);
    }

    public function update(Customer $customer, array $data)
    {
        $customer->update($data);
        return $customer;
    }

    public function delete(Customer $customer)
    {
        $customer->delete();
    }
    public function getAllPaginated($perPage = 10)
    {
        return Customer::paginate($perPage);
    }
    public function search($search, $perPage = 10)
    {
        return Customer::query()
            ->when($search, function ($query) use ($search) {
                $query->where(DB::raw('LOWER(name)'), 'LIKE', '%' . strtolower($search) . '%')
                    ->orWhere(DB::raw('LOWER(email)'), 'LIKE', '%' . strtolower($search) . '%');
            })
            ->orderBy('created_at', 'desc')
            ->paginate($perPage);
    }
}
