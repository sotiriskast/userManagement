<?php
namespace App\Services;

use App\Models\Transaction;
use App\Repositories\TransactionRepository;
use Illuminate\Database\Eloquent\Collection;

class TransactionService
{
    protected TransactionRepository $transactionRepository;

    public function __construct(TransactionRepository $transactionRepository)
    {
        $this->transactionRepository = $transactionRepository;
    }
    public function createTransaction(array $data): Transaction
    {
        return $this->transactionRepository->create($data);
    }

    public function updateTransaction(Transaction $transaction, array $data): Transaction
    {
        return $this->transactionRepository->update($transaction, $data);
    }

    public function deleteTransaction(Transaction $transaction): void
    {
        $this->transactionRepository->delete($transaction);
    }
    public function searchTransactions($filters, $perPage = 10)
    {
        return $this->transactionRepository->search($filters, $perPage);
    }

    public function getAllCustomers(): Collection
    {
        return $this->transactionRepository->getAllCustomers();
    }
    public function getTransactionCountByCountry(): \Illuminate\Support\Collection
    {
        return $this->transactionRepository->getTransactionCountByCountry();
    }
}
