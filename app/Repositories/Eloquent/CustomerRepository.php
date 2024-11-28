<?php
namespace App\Repositories\Eloquent;
use App\Models\Customer;
use App\Repositories\Contracts\CustomerRepositoryInterface;
use Illuminate\Support\Facades\DB;

class CustomerRepository implements CustomerRepositoryInterface
{
    public function getAll()
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
