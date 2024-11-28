<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Create User
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-md rounded-lg overflow-hidden p-6">
                <form method="POST" action="{{ route('users.store') }}">
                    @csrf
                    <x-input name="name" label="Name" :value="old('name')" required />
                    <x-input name="email" label="Email" type="email" :value="old('email')" required />
                    <x-input name="password" label="Password" type="password" required />
                    <x-input name="password_confirmation" label="Confirm Password" type="password" required />

                    <div class="mt-4">
                        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded shadow">
                            Create User
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
