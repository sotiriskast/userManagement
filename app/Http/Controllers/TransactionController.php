<?php

namespace App\Http\Controllers;

use App\Http\Requests\TransactionRequest;
use App\Models\Transaction;
use App\Services\CurrencyService;
use App\Services\TransactionService;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class TransactionController extends Controller
{
    use AuthorizesRequests;

    protected $transactionService;
    protected $currencyService;


    public function __construct(TransactionService $transactionService, CurrencyService $currencyService)
    {
        $this->transactionService = $transactionService;
        $this->currencyService = $currencyService;
        $this->middleware('auth');
        $this->authorizeResource(Transaction::class, 'transaction');

    }

    public function index(Request $request)
    {
        $filters = $request->only(['search', 'date', 'currency']);
        $transactions = $this->transactionService->searchTransactions($filters, 10);
        $currencies = $this->currencyService->getAllCurrencies();
        return view('transactions.index', compact('transactions', 'currencies'));
    }

    public function create()
    {
        $customers = $this->transactionService->getAllCustomers();
        $currencies = $this->currencyService->getAllCurrencies();
        return view('transactions.create', compact('customers', 'currencies'));
    }

    public function store(TransactionRequest $request)
    {
        $this->transactionService->createTransaction($request->validated());
        return redirect()
            ->route('transactions.index')
            ->with('type', 'success')
            ->with('message', 'Transaction created successfully!');
    }

    public function show(Transaction $transaction)
    {
        return view('transactions.show', compact('transaction'));
    }

    public function edit(Transaction $transaction)
    {
        $customers = $this->transactionService->getAllCustomers();
        $currencies = $this->currencyService->getAllCurrencies();
        return view('transactions.edit', compact('transaction', 'customers', 'currencies'));
    }

    public function update(TransactionRequest $request, Transaction $transaction)
    {
        $this->transactionService->updateTransaction($transaction, $request->validated());
        return redirect()
            ->route('transactions.index')
            ->with('type', 'success')
            ->with('message', 'Transaction updated successfully!');
    }

    public function destroy(Transaction $transaction)
    {
        $this->transactionService->deleteTransaction($transaction);
        return redirect()->route('transactions.index')->with('success', 'Transaction deleted successfully');
    }
}
