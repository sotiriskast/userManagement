<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ 'Edit Customer'  }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-md rounded-lg overflow-hidden p-6">
                <form method="POST" action="{{ route('customers.update', $customer)}}">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                            <input type="text" name="name" id="name" class="w-full px-4 py-2 border rounded"
                                   value="{{ old('name', $customer->name) }}" required>
                        </div>
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                            <input type="email" name="email" id="email" step="0.01"
                                   class="w-full px-4 py-2 border rounded"
                                   value="{{ old('email', $customer->email) }}" required>
                        </div>
                        <div>
                            <label for="ip_address" class="block text-sm font-medium text-gray-700">Ip Address</label>
                            <input type="text" name="ip_address" id="ip_address" class="w-full px-4 py-2 border rounded"
                                   value="{{ old('ip_address', $customer->ip_address) }}" required>
                        </div>
                        <div>
                            <label for="country" class="block text-sm font-medium text-gray-700">Country</label>
                            <input type="text" name="country" id="country"
                                   class="w-full px-4 py-2 border rounded"
                                   value="{{ old('country', $customer->country) }}" required>
                        </div>
                    </div>

                    <div class="mt-6">
                        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded shadow">
                            {{ 'Update Customer' }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
