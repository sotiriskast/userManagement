<?php

namespace App\Repositories;

use App\Models\Customer;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class CustomerRepository
{
    public function getAll(): Collection
    {
        return Customer::all();
    }

    public function findById($id): ?Customer
    {
        return Customer::findOrFail($id);
    }

    public function create(array $data): Customer
    {
        return Customer::create($data);
    }

    public function update(Customer $customer, array $data): Customer
    {
        $customer->update($data);
        return $customer;
    }

    public function delete(Customer $customer): void
    {
        $customer->delete();
    }

    public function getAllPaginated($perPage = 10)
    {
        return Customer::paginate($perPage);
    }

    public function search($filters, $perPage = 10): LengthAwarePaginator
    {
        return Customer::with('country')
            ->when($filters['search'] ?? null, function ($query, $search) {
                $query->where(function ($query) use ($search) {
                    $query->where(DB::raw('LOWER(name)'), 'LIKE', '%' . strtolower($search) . '%')
                        ->orWhere(DB::raw('LOWER(email)'), 'LIKE', '%' . strtolower($search) . '%');
                });
            })
            ->when($filters['country'] ?? null, function ($query, $country) {
                $query->whereHas('country', function ($countryQuery) use ($country) {
                    $countryQuery->where('id', $country);
                });
            })
            ->orderBy('created_at', 'desc')
            ->paginate($perPage);
    }

}
