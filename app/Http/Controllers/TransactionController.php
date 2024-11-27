<?php

namespace App\Http\Controllers;

use App\Http\Requests\TransactionRequest;
use App\Models\Transaction;
use App\Services\TransactionService;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    protected $transactionService;

    public function __construct(TransactionService $transactionService)
    {
        $this->transactionService = $transactionService;
    }

    public function index(Request $request)
    {
        $filters = $request->only(['date', 'email', 'currency']);
        $transactions = $this->transactionService->getFilteredTransactions($filters);
        $countryData = $this->transactionService->getTransactionCountByCountry();
        return view('transactions.index', compact('transactions', 'countryData'));
    }

    public function create()
    {
        return view('transactions.create');
    }

    public function store(TransactionRequest $request)
    {
        $transaction = $this->transactionService->createTransaction($request->validated());
        return redirect()->route('transactions.index')->with('success', 'Transaction created successfully');
    }

    public function show(Transaction $transaction)
    {
        return view('transactions.show', compact('transaction'));
    }

    public function edit(Transaction $transaction)
    {
        return view('transactions.edit', compact('transaction'));
    }

    public function update(TransactionRequest $request, Transaction $transaction)
    {
        $this->transactionService->updateTransaction($transaction, $request->validated());
        return redirect()->route('transactions.index')->with('success', 'Transaction updated successfully');
    }

    public function destroy(Transaction $transaction)
    {
        $this->transactionService->deleteTransaction($transaction);
        return redirect()->route('transactions.index')->with('success', 'Transaction deleted successfully');
    }
}
