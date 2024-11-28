<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ 'Create Transaction' }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-md rounded-lg overflow-hidden p-6">
                <form method="POST"
                      action="{{ route('transactions.store') }}">
                    @csrf
                    <!-- Customer Dropdown -->
                    <x-select name="customer_id" label="Customer" :placeholder="'Select a Customer'">
                        @foreach ($customers as $customer)
                            <option value="{{ $customer->id }}">
                                {{ $customer->name }}
                            </option>
                        @endforeach
                    </x-select>
                    <!-- Amount Input -->
                    <x-input name="amount" label="Amount" type="number" :value="''" />
                    <!-- Currency Dropdown -->
                    <x-select name="currency_id" label="Currency" :placeholder="'Select a Currency'">
                        @foreach ($currencies as $currency)
                            <option value="{{ $currency->id }}">
                                {{ $currency->name }} ({{ $currency->code }})
                            </option>
                        @endforeach
                    </x-select>
                    <!-- Transaction Date -->
                    <x-input name="transaction_date" label="Transaction Date" type="date"
                             :value="''" />
                    <!-- Submit Button -->
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
