<?php

namespace App\Repositories;

use App\Models\Customer;
use App\Models\Transaction;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class TransactionRepository
{

    public function create(array $data): Transaction
    {
        return Transaction::create($data);
    }

    public function update(Transaction $transaction, array $data): Transaction
    {
        $transaction->update($data);
        return $transaction;
    }

    public function delete(Transaction $transaction): void
    {
        $transaction->delete();
    }

    public function search($filters, $perPage = 10): LengthAwarePaginator
    {
        return Transaction::with('customer', 'currency')
            ->when($filters['search'] ?? null, function ($query, $search) {
                $query->whereHas('customer', function ($customerQuery) use ($search) {
                    $customerQuery->where(DB::raw('LOWER(name)'), 'LIKE', '%' . strtolower($search) . '%');
                });
            })
            ->when($filters['date'] ?? null, function ($query, $date) {
                $query->whereDate('transaction_date', $date);
            })
            ->when($filters['currency'] ?? null, function ($query, $currency) {
                $query->whereHas('currency', function ($currencyQuery) use ($currency) {
                    $currencyQuery->where(DB::raw('LOWER(code)'), 'LIKE', '%' . strtolower($currency) . '%');
                });
            })
            ->orderBy('created_at', 'desc')
            ->paginate($perPage);
    }

    public function getAllCustomers(): Collection
    {
        return Customer::all();
    }

    public function getTransactionCountByCountry(): \Illuminate\Support\Collection
    {
        return DB::table('transactions')
            ->join('customers', 'transactions.customer_id', '=', 'customers.id')
            ->join('countries', 'customers.country_id', '=', 'countries.id')
            ->select('countries.name as country', DB::raw('COUNT(transactions.id) as total'))
            ->groupBy('countries.name')
            ->orderBy('total', 'desc')
            ->get();
    }
}
