<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create User') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-md rounded-lg overflow-hidden p-6">
                <form method="POST" action="{{ route('users.store') }}">
                    @csrf

                    <!-- Name -->
                    <x-input name="name" label="Name" :value="old('name')" />

                    <!-- Email -->
                    <x-input name="email" label="Email" type="email" :value="old('email')" />

                    <!-- Password -->
                    <x-input name="password" label="Password" type="password" />

                    <!-- Confirm Password -->
                    <x-input name="password_confirmation" label="Confirm Password" type="password" />
                    <!-- Roles -->
                    <div class="mb-4">
                        <label for="roles" class="block text-sm font-medium text-gray-700">Roles</label>
                        <div class="flex flex-col space-y-2">
                            @foreach ($roles as $role)
                                <label class="inline-flex items-center">
                                    <input type="radio" name="role" value="{{ $role->id }}"
                                           class="form-radio text-blue-600"
                                        {{ old('role') == $role->id ? 'checked' : '' }}>
                                    <span class="ml-2">{{ ucfirst($role->name) }}</span>
                                </label>
                            @endforeach
                        </div>
                        @error('role')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Submit -->
                    <div class="mt-6">
                        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded shadow">
                            Create User
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
