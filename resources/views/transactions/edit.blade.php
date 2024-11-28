<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ isset($transaction) ? 'Edit Transaction' : 'Create Transaction' }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-md rounded-lg overflow-hidden p-6">
                <form method="POST"
                      action="{{ isset($transaction) ? route('transactions.update', $transaction) : route('transactions.store') }}">
                    @csrf
                    @if(isset($transaction))
                        @method('PUT')
                    @endif

                    <!-- Customer Dropdown -->
                    <x-select name="client_id" label="Customer" :placeholder="'Select a Customer'">
                        @foreach ($customers as $customer)
                            <option value="{{ $customer->client_id }}"
                                {{ old('client_id', $transaction->client_id ?? '') === $customer->client_id ? 'selected' : '' }}>
                                {{ $customer->name }}
                            </option>
                        @endforeach
                    </x-select>

                    <!-- Amount Input -->
                    <x-input name="amount" label="Amount" type="number"
                             :value="old('amount', $transaction->amount ?? '')" />

                    <!-- Currency Dropdown -->
                    <x-select name="currency" label="Currency" :placeholder="'Select a Currency'">
                        @foreach ($currencies as $currency)
                            <option value="{{ $currency->code }}"
                                {{ old('currency', $transaction->currency ?? '') === $currency->code ? 'selected' : '' }}>
                                {{ $currency->name }} ({{ $currency->code }})
                            </option>
                        @endforeach
                    </x-select>

                    <!-- Transaction Date -->
                    <x-input name="transaction_date" label="Transaction Date" type="date"
                             :value="old('transaction_date', $transaction->transaction_date ?? '')" />

                    <!-- Submit Button -->
                    <div class="mt-6">
                        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded shadow">
                            {{ isset($transaction) ? 'Update Transaction' : 'Create Transaction' }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
