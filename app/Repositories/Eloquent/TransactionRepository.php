<?php
namespace App\Repositories\Eloquent;
use App\Models\Customer;
use App\Models\Transaction;
use App\Repositories\Contracts\TransactionRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class TransactionRepository implements TransactionRepositoryInterface
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

    public function search($filters, $perPage = 10): \Illuminate\Contracts\Pagination\LengthAwarePaginator
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
                $query->where(DB::raw('LOWER(currency)'), 'LIKE', '%' . strtolower($currency). '%');
            })
            ->orderBy('created_at', 'desc')
            ->paginate($perPage);
    }

    public function getAllCustomers(): Collection
    {
        return Customer::all();
    }
}
