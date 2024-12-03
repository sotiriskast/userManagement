<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Transactions') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-md rounded-lg overflow-hidden">
                <div class="p-6 bg-gray-100 border-b border-gray-200">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-semibold text-gray-700">Transaction List</h3>
                        <x-role-button role="admin" href="{{ route('transactions.create') }}">
                            + Add Transaction
                        </x-role-button>
                    </div>

                    <!-- Filter Form -->
                    <form method="GET" action="{{ route('transactions.index') }}" class="mb-4">
                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                            <div>
                                <label for="search" class="block text-sm font-medium text-gray-700">Customer Name</label>
                                <input type="text" name="search" id="search" placeholder="Search by Customer Name"
                                       class="w-full px-4 py-2 border border-gray-300 rounded shadow-sm focus:ring focus:ring-blue-300 focus:outline-none"
                                       value="{{ request('search') }}">
                            </div>
                            <div>
                                <label for="date" class="block text-sm font-medium text-gray-700">Transaction Date</label>
                                <input type="date" name="date" id="date" class="w-full px-4 py-2 border border-gray-300 rounded shadow-sm focus:ring focus:ring-blue-300 focus:outline-none"
                                       value="{{ request('date') }}">
                            </div>
                            <div>
                                <label for="currency" class="block text-sm font-medium text-gray-700">Currency</label>
                                <select name="currency" class="w-full px-4 py-2 border border-gray-300 rounded shadow-sm focus:ring focus:ring-blue-300 focus:outline-none">
                                    <option value="">All Currencies</option>
                                    @foreach ($currencies as $currency)
                                        <option value="{{ $currency->code }}"
                                            {{ request('currency') == $currency->code ? 'selected' : '' }}>
                                            {{ $currency->name }} ({{ $currency->code }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="mt-4">
                            <button type="submit" class="bg-gray-800 text-white px-4 py-2 rounded shadow hover:bg-gray-700">
                                Filter
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Transactions Table -->
                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white">
                        <thead class="bg-gray-200 text-gray-700 uppercase text-sm leading-normal">
                        <tr>
                            <th class="py-3 px-6 text-left">Transaction ID</th>
                            <th class="py-3 px-6 text-left">Name</th>
                            <th class="py-3 px-6 text-left">Amount</th>
                            <th class="py-3 px-6 text-left">Currency</th>
                            <th class="py-3 px-6 text-left">Date</th>
                            <th class="py-3 px-6 text-center">Actions</th>
                        </tr>
                        </thead>
                        <tbody class="text-gray-600 text-sm font-light">
                        @forelse ($transactions as $transaction)
                            <tr class="border-b border-gray-200 hover:bg-gray-100">
                                <td class="py-3 px-6 text-left whitespace-nowrap">{{ $transaction->id }}</td>
                                <td class="py-3 px-6 text-left whitespace-nowrap">
                                    {{ $transaction->customer->name ?? 'Unknown Customer' }}
                                </td>
                                <td class="py-3 px-6 text-left">{{ $transaction->amount }}</td>
                                <td class="py-3 px-6 text-left">{{ $transaction->currency->name }} ({{ $transaction->currency->code }})</td>
                                <td class="py-3 px-6 text-left">{{ $transaction->transaction_date->format('d/m/Y') }}</td>
                                <td class="py-3 px-6 text-center">
                                    <div class="flex item-center justify-center space-x-2">
                                        <a href="{{ route('transactions.show', $transaction) }}"
                                           class="w-8 h-8 bg-blue-500 hover:bg-blue-600 text-white rounded-full flex items-center justify-center">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        @can('update', $transaction)
                                            <a href="{{ route('transactions.edit', $transaction) }}"
                                               class="w-8 h-8 bg-green-500 hover:bg-green-600 text-white rounded-full flex items-center justify-center">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                        @endcan
                                        @can('delete', $transaction)
                                            <form action="{{ route('transactions.destroy', $transaction) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                        class="w-8 h-8 bg-red-500 hover:bg-red-600 text-white rounded-full flex items-center justify-center"
                                                        onclick="return confirm('Are you sure?')">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        @endcan
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="py-3 px-6 text-center text-gray-500">
                                    No transactions found.
                                </td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="p-6 bg-gray-100 border-t border-gray-200">
                    {{ $transactions->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
