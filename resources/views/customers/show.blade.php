<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Customer Details
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-md rounded-lg overflow-hidden">
                <div class="p-6 bg-gray-100 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-700">Customer Information</h3>
                </div>

                <div class="p-6">
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <strong>Client ID:</strong>
                            <p>{{ $customer->client_id }}</p>
                        </div>
                        <div>
                            <strong>Name:</strong>
                            <p>{{ $customer->name }}</p>
                        </div>
                        <div>
                            <strong>Email:</strong>
                            <p>{{ $customer->email }}</p>
                        </div>
                        <div>
                            <strong>IP Address:</strong>
                            <p>{{ $customer->ip_address }}</p>
                        </div>
                        <div>
                            <strong>Country:</strong>
                            <p>{{ $customer->country->name }}</p>
                        </div>
                        <div>
                            <strong>Created At:</strong>
                            <p>{{ $customer->created_at->format('Y-m-d H:i') }}</p>
                        </div>
                        <div>
                            <strong>Updated At:</strong>
                            <p>{{ $customer->updated_at->format('Y-m-d H:i') }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Associated Transactions -->
            <div class="bg-white shadow-md rounded-lg overflow-hidden mt-6">
                <div class="p-6 bg-gray-100 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-700">Associated Transactions</h3>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white">
                        <thead class="bg-gray-200 text-gray-700 uppercase text-sm leading-normal">
                        <tr>
                            <th class="py-3 px-6 text-left">Transaction ID</th>
                            <th class="py-3 px-6 text-left">Amount</th>
                            <th class="py-3 px-6 text-left">Currency</th>
                            <th class="py-3 px-6 text-left">Date</th>
                            <th class="py-3 px-6 text-center">Actions</th>
                        </tr>
                        </thead>
                        <tbody class="text-gray-600 text-sm font-light">
                        @forelse ($customer->transactions as $transaction)
                            <tr class="border-b border-gray-200 hover:bg-gray-100">
                                <td class="py-3 px-6 text-left whitespace-nowrap">{{ $transaction->id }}</td>
                                <td class="py-3 px-6 text-left">{{ $transaction->amount }}</td>
                                <td class="py-3 px-6 text-left">{{ $transaction->currency->name.' ('.$transaction->currency->code.')' }}</td>
                                <td class="py-3 px-6 text-left">{{ $transaction->transaction_date }}</td>
                                <td class="py-3 px-6 text-center">
                                    <a href="{{ route('transactions.show', $transaction) }}"
                                       class="text-blue-500 hover:text-blue-700">View</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="py-3 px-6 text-center text-gray-500">
                                    No transactions found for this customer.
                                </td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
