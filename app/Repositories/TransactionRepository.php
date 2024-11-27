<?php
namespace App\Repositories;
use App\Models\Transaction;
use Illuminate\Support\Facades\DB;

class TransactionRepository
{
    public function getAll()
    {
        return Transaction::with('customer')->get();
    }

    public function findById($id)
    {
        return Transaction::with('customer')->findOrFail($id);
    }

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

    public function getFilteredTransactions($filters)
    {
        $query = Transaction::with('customer');

        if (isset($filters['date'])) {
            $query->whereDate('transaction_date', $filters['date']);
        }

        if (isset($filters['email'])) {
            $query->whereHas('customer', function ($q) use ($filters) {
                $q->where('email', 'like', '%' . $filters['email'] . '%');
            });
        }

        if (isset($filters['currency'])) {
            $query->where('currency', $filters['currency']);
        }

        return $query->get();
    }

    public function getTransactionCountByCountry()
    {
        return Transaction::join('customers', 'transactions.client_id', '=', 'customers.client_id')
            ->select('customers.country', DB::raw('count(*) as total'))
            ->groupBy('customers.country')
            ->get();
    }
}
