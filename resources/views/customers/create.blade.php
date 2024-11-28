<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ isset($customer) ? 'Edit Customer' : 'Create Customer' }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-md rounded-lg overflow-hidden p-6">
                <form method="POST" action="{{ isset($customer) ? route('customers.update', $customer) : route('customers.store') }}">
                    @csrf
                    @if(isset($customer))
                        @method('PUT')
                    @endif

                    <!-- Name Input -->
                    <x-input name="name" label="Name" :value="$customer->name ?? null" />
                    <!-- Email Input -->
                    <x-input name="email" label="Email" type="email" :value="$customer->email ?? null" />
                    <!-- IP Address Input -->
                    <x-input name="ip_address" label="IP Address" :value="$customer->ip_address ?? null" />
                    <!-- Country Input -->
                    <div class="mb-4">
                        <x-select name="country_id" label="Country" :placeholder="'Select a Country'">
                            @foreach ($countries as $country)
                                <option value="{{ $country->id }}"
                                    {{ old('country_id', $customer->country_id ?? '') == $country->id ? 'selected' : '' }}>
                                    {{ $country->name }}
                                </option>
                            @endforeach
                        </x-select>
                    </div>
                    <div class="mt-6">
                        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded shadow">
                            {{ isset($customer) ? 'Update Customer' : 'Create Customer' }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
