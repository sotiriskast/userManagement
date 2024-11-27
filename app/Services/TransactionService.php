<?php
namespace App\Services;

use App\Models\Transaction;
use App\Repositories\TransactionRepository;

class TransactionService
{
    protected $transactionRepository;

    public function __construct(TransactionRepository $transactionRepository)
    {
        $this->transactionRepository = $transactionRepository;
    }
    public function createTransaction(array $data)
    {
        return $this->transactionRepository->create($data);
    }

    public function updateTransaction(Transaction $transaction, array $data)
    {
        return $this->transactionRepository->update($transaction, $data);
    }

    public function deleteTransaction(Transaction $transaction)
    {
        $this->transactionRepository->delete($transaction);
    }
    public function searchTransactions($filters, $perPage = 10)
    {
        return $this->transactionRepository->search($filters, $perPage);
    }

    public function getAllCustomers()
    {
        return $this->transactionRepository->getAllCustomers();
    }
}
