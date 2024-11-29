<?php
namespace App\Services;

use App\Models\Transaction;
use App\Repositories\Contracts\TransactionRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class TransactionService
{
    protected TransactionRepositoryInterface $transactionRepositoryInterface;

    public function __construct(TransactionRepositoryInterface $transactionRepositoryInterface)
    {
        $this->transactionRepositoryInterface = $transactionRepositoryInterface;
    }
    public function createTransaction(array $data): Transaction
    {
        return $this->transactionRepositoryInterface->create($data);
    }

    public function updateTransaction(Transaction $transaction, array $data): Transaction
    {
        return $this->transactionRepositoryInterface->update($transaction, $data);
    }

    public function deleteTransaction(Transaction $transaction): void
    {
        $this->transactionRepositoryInterface->delete($transaction);
    }
    public function searchTransactions($filters, $perPage = 10)
    {
        return $this->transactionRepositoryInterface->search($filters, $perPage);
    }

    public function getAllCustomers(): Collection
    {
        return $this->transactionRepositoryInterface->getAllCustomers();
    }
    public function getTransactionCountByCountry(): \Illuminate\Support\Collection
    {
        return $this->transactionRepositoryInterface->getTransactionCountByCountry();
    }
}
