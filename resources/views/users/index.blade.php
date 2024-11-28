<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Users
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-md rounded-lg overflow-hidden">
                <div class="p-6 bg-gray-100 border-b border-gray-200">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-semibold text-gray-700">User List</h3>
                        @can('create', App\Models\User::class)
                            <a href="{{ route('users.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded shadow">
                                + Add User
                            </a>
                        @endcan
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white">
                        <thead class="bg-gray-200 text-gray-700 uppercase text-sm leading-normal">
                        <tr>
                            <th class="px-6 py-3 text-left">Name</th>
                            <th class="px-6 py-3 text-left">Email</th>
                            <th class="px-6 py-3 text-center">Actions</th>
                        </tr>
                        </thead>
                        <tbody class="text-gray-600 text-sm font-light">
                        @foreach ($users as $user)
                            <tr class="border-b border-gray-200 hover:bg-gray-100">
                                <td class="px-6 py-4">{{ $user->name }}</td>
                                <td class="px-6 py-4">{{ $user->email }}</td>
                                <td class="px-6 py-4 text-center">
                                    <a href="{{ route('users.show', $user) }}" class="text-blue-500 hover:underline">View</a>
                                    @can('update', $user)
                                        <a href="{{ route('users.edit', $user) }}" class="text-yellow-500 hover:underline">Edit</a>
                                    @endcan
                                    @can('delete', $user)
                                        <form action="{{ route('users.destroy', $user) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-500 hover:underline"
                                                    onclick="return confirm('Are you sure?')">Delete</button>
                                        </form>
                                    @endcan
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="p-6 bg-gray-100 border-t border-gray-200">
                    {{ $users->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
