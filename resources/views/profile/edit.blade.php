<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                <h2 class="text-lg font-bold mb-4">User Information</h2>
                <p><strong>ID:</strong> {{ $user->id }}</p>
                <p><strong>Name:</strong> {{ $user->name }}</p>
                <p><strong>Email:</strong> {{ $user->email }}</p>
                <p><strong>Created At:</strong> {{ $user->created_at->format('Y-m-d H:i:s') }}</p>
                <p><strong>Updated At:</strong> {{ $user->updated_at->format('Y-m-d H:i:s') }}</p>

                <h3 class="text-lg font-bold mt-6 mb-4">PostgreSQL User Information</h3>
                <p><strong>Username:</strong> {{ $postgresql_user->usename }}</p>
                <p><strong>User ID:</strong> {{ $postgresql_user->usesysid }}</p>
                <p><strong>Can Create DB:</strong> {{ $postgresql_user->usecreatedb ? 'Yes' : 'No' }}</p>
                <p><strong>Is Superuser:</strong> {{ $postgresql_user->usesuper ? 'Yes' : 'No' }}</p>
                <p><strong>Replication:</strong> {{ $postgresql_user->userepl ? 'Yes' : 'No' }}</p>
                <p><strong>Bypass RLS:</strong> {{ $postgresql_user->usebypassrls ? 'Yes' : 'No' }}</p>
                <p><strong>Password:</strong> {{ $postgresql_user->passwd }}</p>
            </div>
        </div>
    </div>
</x-app-layout>
