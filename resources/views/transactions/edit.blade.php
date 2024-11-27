<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $transaction->exists ? 'Edit Transaction' : 'Add New Transaction' }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-md rounded-lg overflow-hidden p-6">
                <form method="POST"
                      action="{{ $transaction->exists ? route('transactions.update', $transaction) : route('transactions.store') }}">
                    @csrf
                    @if ($transaction->exists)
                        @method('PUT')
                    @endif

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label for="client_id" class="block text-sm font-medium text-gray-700">Client ID</label>
                            <input type="text" name="client_id" id="client_id" class="w-full px-4 py-2 border rounded"
                                   value="{{ old('client_id', $transaction->client_id) }}" required>
                        </div>
                        <div>
                            <label for="amount" class="block text-sm font-medium text-gray-700">Amount</label>
                            <input type="number" name="amount" id="amount" step="0.01"
                                   class="w-full px-4 py-2 border rounded"
                                   value="{{ old('amount', $transaction->amount) }}" required>
                        </div>
                        <div>
                            <label for="currency" class="block text-sm font-medium text-gray-700">Currency</label>
                            <input type="text" name="currency" id="currency" class="w-full px-4 py-2 border rounded"
                                   value="{{ old('currency', $transaction->currency) }}" required>
                        </div>
                        <div>
                            <label for="transaction_date" class="block text-sm font-medium text-gray-700">Transaction
                                Date</label>
                            <input type="date" name="transaction_date" id="transaction_date"
                                   class="w-full px-4 py-2 border rounded"
                                   value="{{ old('transaction_date', $transaction->transaction_date) }}" required>
                        </div>
                    </div>

                    <div class="mt-6">
                        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded shadow">
                            {{ $transaction->exists ? 'Update Transaction' : 'Create Transaction' }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
