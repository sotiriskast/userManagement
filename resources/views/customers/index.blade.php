<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Customers') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-md rounded-lg overflow-hidden">
                <div class="p-6 bg-gray-100 border-b border-gray-200">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-semibold text-gray-700">Customer List</h3>
                        <x-role-button role="Admin" href="{{ route('customers.create') }}">
                            + Add Customer
                        </x-role-button>
                    </div>
                    <!-- Search Bar -->
                    <form method="GET" action="{{ route('customers.index') }}" class="mb-4">
                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                            <!-- Search by Name or Email -->
                            <input type="text" name="search" placeholder="Search by Name or Email"
                                   class="w-full px-4 py-2 border border-gray-300 rounded shadow-sm focus:ring focus:ring-blue-300 focus:outline-none"
                                   value="{{ request('search') }}">

                            <!-- Filter by Country -->
                            <select name="country" class="w-full px-4 py-2 border border-gray-300 rounded shadow-sm focus:ring focus:ring-blue-300 focus:outline-none">
                                <option value="">All Countries</option>
                                @foreach ($countries as $country)
                                    <option value="{{ $country->id }}" {{ (int) request('country') === $country->id ? 'selected' : '' }}>
                                        {{ $country->name }}
                                    </option>
                                @endforeach
                            </select>

                            <!-- Search Button -->
                            <button type="submit" class="bg-gray-800 text-white px-4 py-2 rounded hover:bg-gray-700 shadow">
                                Search
                            </button>
                        </div>
                    </form>
                </div>
                <!-- Customer Table -->
                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white">
                        <thead class="bg-gray-200 text-gray-700 uppercase text-sm leading-normal">
                        <tr>
                            <th class="py-3 px-6 text-left">Client ID</th>
                            <th class="py-3 px-6 text-left">Name</th>
                            <th class="py-3 px-6 text-left">Email</th>
                            <th class="py-3 px-6 text-left">IP Address</th>
                            <th class="py-3 px-6 text-left">Country</th>
                            <th class="py-3 px-6 text-center">Actions</th>
                        </tr>
                        </thead>
                        <tbody class="text-gray-600 text-sm font-light">
                        @forelse ($customers as $customer)
                            <tr class="border-b border-gray-200 hover:bg-gray-100">
                                <td class="py-3 px-6 text-left whitespace-nowrap">{{ $customer->client_id }}</td>
                                <td class="py-3 px-6 text-left">{{ $customer->name }}</td>
                                <td class="py-3 px-6 text-left">{{ $customer->email }}</td>
                                <td class="py-3 px-6 text-left">{{ $customer->ip_address }}</td>
                                <td class="py-3 px-6 text-left">{{ $customer->country->name }} ({{ $customer->country->code }})</td>

                                <td class="py-3 px-6 text-center">
                                    <div class="flex item-center justify-center space-x-2">
                                        <a href="{{ route('customers.show', $customer) }}"
                                           class="w-8 h-8 bg-blue-500 hover:bg-blue-600 text-white rounded-full flex items-center justify-center">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        @can('update', $customer)
                                            <a href="{{ route('customers.edit', $customer) }}"
                                               class="w-8 h-8 bg-green-500 hover:bg-green-600 text-white rounded-full flex items-center justify-center">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                        @endcan
                                        @can('delete', $customer)
                                            <form action="{{ route('customers.destroy', $customer) }}" method="POST">
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
                                <td colspan="6" class="py-3 px-6 text-center text-gray-500">
                                    No customers found.
                                </td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="p-6 bg-gray-100 border-t border-gray-200">
                    {{ $customers->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
