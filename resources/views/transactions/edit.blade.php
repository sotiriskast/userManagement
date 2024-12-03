<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ 'Edit Transaction' }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-md rounded-lg overflow-hidden p-6">
                <form method="POST"
                      action="{{ route('transactions.update', $transaction)  }}">
                    @csrf
                    @method('PUT')

                    <!-- Customer Dropdown -->
                    <x-select name="customer_id" label="Customer" :placeholder="'Select a Customer'">
                        @foreach ($customers as $customer)
                            <option value="{{ $customer->id }}"
                                {{ old('customer_id', $transaction->customer_id) == $customer->id ? 'selected' : '' }}>
                                {{ $customer->name }}
                            </option>
                        @endforeach
                    </x-select>

                    <!-- Amount Input -->
                    <x-input name="amount" label="Amount" type="number"
                             :value="old('amount', $transaction->amount)"/>

                    <!-- Currency Dropdown -->
                    <x-select name="currency_id" label="Currency" :placeholder="'Select a Currency'">
                        @foreach ($currencies as $currency)
                            <option value="{{ $currency->id }}"
                                {{ (int) old('currency_id', $transaction->currency_id) === $currency->id ? 'selected' : '' }}>
                                {{ $currency->name }} ({{ $currency->code }})
                            </option>
                        @endforeach
                    </x-select>

                    <x-input name="transaction_date" label="Transaction Date" type="date"
                             :value="old('transaction_date', $transaction->transaction_date ? $transaction->transaction_date->format('Y-m-d') : '')" />

                    <!-- Submit Button -->
                    <div class="mt-6">
                        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded shadow">
                            {{  'Update Transaction' }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
