<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Transaction Details
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-md rounded-lg overflow-hidden">
                <div class="p-6 bg-gray-100 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-700">Transaction Information</h3>
                </div>

                <div class="p-6">
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <strong>Transaction ID:</strong>
                            <p>{{ $transaction->id }}</p>
                        </div>
                        <div>
                            <strong>Client ID:</strong>
                            <p>{{ $transaction->customer->client_id }}</p>
                        </div>
                        <div>
                            <strong>Client Name:</strong>
                            <p>{{ $transaction->customer->name }}</p>
                        </div>
                        <div>
                            <strong>Amount:</strong>
                            <p>{{ $transaction->amount }}</p>
                        </div>
                        <div>
                            <strong>Currency:</strong>
                            <p>{{ $transaction->currency->name .' ('.$transaction->currency->code.')' }}</p>
                        </div>
                        <div>
                            <strong>Date:</strong>
                            <p>{{ $transaction->transaction_date }}</p>
                        </div>
                        <div>
                            <strong>Created At:</strong>
                            <p>{{ $transaction->created_at->format('Y-m-d H:i') }}</p>
                        </div>
                        <div>
                            <strong>Updated At:</strong>
                            <p>{{ $transaction->updated_at->format('Y-m-d H:i') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
