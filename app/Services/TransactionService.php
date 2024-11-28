<?php
namespace App\Services;

use App\Models\Transaction;
use App\Repositories\Contracts\TransactionRepositoryInterface;

class TransactionService
{
    protected $transactionRepositoryInterface;

    public function __construct(TransactionRepositoryInterface $transactionRepositoryInterface)
    {
        $this->transactionRepositoryInterface = $transactionRepositoryInterface;
    }
    public function createTransaction(array $data)
    {
        return $this->transactionRepositoryInterface->create($data);
    }

    public function updateTransaction(Transaction $transaction, array $data)
    {
        return $this->transactionRepositoryInterface->update($transaction, $data);
    }

    public function deleteTransaction(Transaction $transaction)
    {
        $this->transactionRepositoryInterface->delete($transaction);
    }
    public function searchTransactions($filters, $perPage = 10)
    {
        return $this->transactionRepositoryInterface->search($filters, $perPage);
    }

    public function getAllCustomers()
    {
        return $this->transactionRepositoryInterface->getAllCustomers();
    }
}
