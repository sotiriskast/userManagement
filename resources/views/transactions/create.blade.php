<x-app-layout>
    <x-slot name="header">

    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ 'Add New Transaction' }}
    </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-md rounded-lg overflow-hidden p-6">
                <form method="POST" action="{{ route('transactions.store') }}">
                    @csrf

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label for="client_id" class="block text-sm font-medium text-gray-700">Customer</label>
                            <select name="client_id" id="client_id" class="w-full px-4 py-2 border rounded shadow-sm focus:ring focus:ring-blue-300 focus:outline-none" required>
                                @foreach ($customers as $customer)
                                    <option value="{{ $customer->client_id }}">{{ $customer->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label for="amount" class="block text-sm font-medium text-gray-700">Amount</label>
                            <input type="number" name="amount" id="amount" step="0.01"
                                   class="w-full px-4 py-2 border rounded"
                                   value="" required>
                        </div>
                        <div>
                            <label for="currency" class="block text-sm font-medium text-gray-700">Currency</label>
                            <input type="text" name="currency" id="currency" class="w-full px-4 py-2 border rounded"
                                   value="" required>
                        </div>
                        <div>
                            <label for="transaction_date" class="block text-sm font-medium text-gray-700">Transaction Date</label>
                            <input type="date" name="transaction_date" id="transaction_date"
                                   class="w-full px-4 py-2 border rounded"
                                   value="" required>
                        </div>
                    </div>

                    <div class="mt-6">
                        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded shadow">
                            {{ 'Create Transaction' }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
