<?php
namespace App\Repositories\Contracts;

use App\Models\Transaction;
use Illuminate\Database\Eloquent\Collection;

interface TransactionRepositoryInterface
{
    public function create(array $data): Transaction;
    public function update(Transaction $transaction, array $data): Transaction;
    public function delete(Transaction $transaction): void;
    public function search(array $filters, int $perPage = 10);
    public function getAllCustomers():Collection;

}
