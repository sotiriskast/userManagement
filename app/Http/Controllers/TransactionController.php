<?php

namespace App\Http\Controllers;

use App\Http\Requests\TransactionRequest;
use App\Models\Customer;
use App\Models\Transaction;
use App\Services\TransactionService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    protected $transactionService;

    public function __construct(TransactionService $transactionService)
    {
        $this->transactionService = $transactionService;
    }
    public function index(Request $request)
    {
        $filters = $request->only(['search', 'date', 'currency']);
        $transactions = $this->transactionService->searchTransactions($filters, 10);

        return view('transactions.index', compact('transactions'));
    }
    public function create()
    {
        $customers = $this->transactionService->getAllCustomers();
        return view('transactions.create', compact('customers'));    }
    public function store(TransactionRequest $request)
    {
$test='test';
        try {
            $this->transactionService->createTransaction($request->validated());
            dd(DB::getQueryLog());

            return redirect()
                ->route('transactions.index')
                ->with('type', 'success')
                ->with('message', 'Transaction created successfully!');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->withInput()
                ->with('type', 'error')
                ->with('message', 'Failed to create transaction. Please try again.');
        }
        return redirect()->route('transactions.index')->with('success', 'Transaction added successfully!');
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
        try {
            $this->transactionService->updateTransaction($transaction, $request->validated());
            return redirect()
                ->route('transactions.index')
                ->with('type', 'success')
                ->with('message', 'Transaction updated successfully!');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->withInput()
                ->with('type', 'error')
                ->with('message', 'Failed to update transaction. Please try again.');
        }    }
    public function destroy(Transaction $transaction)
    {
        $this->transactionService->deleteTransaction($transaction);
        return redirect()->route('transactions.index')->with('success', 'Transaction deleted successfully');
    }
}
