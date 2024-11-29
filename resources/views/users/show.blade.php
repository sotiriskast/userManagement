<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            User Details
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
                            <strong>User ID:</strong>
                            <p>{{ $user->id }}</p>
                        </div>

                        <div>
                            <strong>Transaction ID:</strong>
                            <p>{{ $user->name }}</p>
                        </div>
                        <div>
                            <strong>Created At:</strong>
                            <p>{{ $user->created_at->format('Y-m-d H:i') }}</p>
                        </div>
                        <div>
                            <strong>Updated At:</strong>
                            <p>{{ $user->updated_at->format('Y-m-d H:i') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
