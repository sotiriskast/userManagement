<?php
namespace App\Repositories;
use App\Models\Customer;
use App\Models\Transaction;
use Illuminate\Support\Facades\DB;

class TransactionRepository
{

    public function create(array $data)
    {
        return Transaction::create($data);
    }
    public function update(Transaction $transaction, array $data)
    {
        $transaction->update($data);
        return $transaction;
    }

    public function delete(Transaction $transaction)
    {
        $transaction->delete();
    }

    public function search($filters, $perPage = 10)
    {
        return Transaction::with('customer')
            ->when($filters['search'] ?? null, function ($query, $search) {
                $query->whereHas('customer', function ($customerQuery) use ($search) {
                    $customerQuery->where(DB::raw('LOWER(name)'), 'LIKE', '%' . strtolower($search) . '%');
                });
            })
            ->when($filters['date'] ?? null, function ($query, $date) {
                $query->whereDate('transaction_date', $date);
            })
            ->when($filters['currency'] ?? null, function ($query, $currency) {
                $query->where(DB::raw('LOWER(currency)'), '=', strtolower($currency));
            })
            ->orderBy('created_at', 'desc')
            ->paginate($perPage);
    }

    public function getAllCustomers()
    {
        return Customer::all();
    }
}
