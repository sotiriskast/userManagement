<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{'Add New Customer' }}
        </h2>
    </x-slot>
    <x-flash-message :type="session('type')" :message="session('message')" />

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-md rounded-lg overflow-hidden p-6">
                <form method="POST" action="{{ route('customers.store') }}">
                    @csrf
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                            <input type="text" name="name" id="name" class="w-full px-4 py-2 border rounded"
                                   value="" required>
                        </div>
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                            <input type="email" name="email" id="email" class="w-full px-4 py-2 border rounded"
                                   value="" required>
                        </div>
                        <div>
                            <label for="ip_address" class="block text-sm font-medium text-gray-700">IP Address</label>
                            <input type="text" name="ip_address" id="ip_address" class="w-full px-4 py-2 border rounded"
                                   value="" required>
                        </div>
                        <div>
                            <label for="country" class="block text-sm font-medium text-gray-700">Country Date</label>
                            <input type="date" name="country" id="country"
                                   class="w-full px-4 py-2 border rounded"
                                   value="" required>
                        </div>
                    </div>

                    <div class="mt-6">
                        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded shadow">
                            {{'Create Customer' }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
