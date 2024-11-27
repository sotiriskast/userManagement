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

    public function getAllTransactions()
    {
        return $this->transactionRepository->getAll();
    }

    public function getTransactionById($id)
    {
        return $this->transactionRepository->findById($id);
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

    public function getFilteredTransactions(array $filters)
    {
        return $this->transactionRepository->getFilteredTransactions($filters);
    }

    public function getTransactionCountByCountry()
    {
        return $this->transactionRepository->getTransactionCountByCountry();
    }
}
