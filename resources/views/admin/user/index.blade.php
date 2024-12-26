@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold text-center text-gray-800 mb-6">Daftar User</h1>

    <!-- Button Tambah User -->
    <div class="flex justify-end mb-4">
        <a href="{{ route('admin.user.create') }}" class="bg-blue-600 text-white py-2 px-4 rounded-lg hover:bg-blue-700 transition duration-300">
            Tambah User
        </a>
    </div>

    <!-- Tabel User -->
    <div class="overflow-x-auto">
        <table class="w-full table-auto bg-white shadow-lg rounded-lg">
            <thead>
                <tr class="bg-orange-600 text-white text-left">
                    <th class="px-4 py-2">#</th>
                    <th class="px-4 py-2">Username</th>
                    <th class="px-4 py-2">Email</th>
                    <th class="px-4 py-2">Role</th>
                    <th class="px-4 py-2 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr class="hover:bg-gray-100 transition duration-200">
                        <td class="border px-4 py-2">{{ $loop->iteration }}</td>
                        <td class="border px-4 py-2">{{ $user->name }}</td>
                        <td class="border px-4 py-2">{{ $user->email }}</td>
                        <td class="border px-4 py-2">{{ ucfirst($user->role) }}</td>
                        <td class="border px-4 py-2 text-center">
                            <div class="flex justify-center space-x-2">
                                <!-- Edit Button -->
                                <a href="{{ route('admin.user.edit', $user->id) }}" class="bg-yellow-500 text-white px-3 py-1 rounded-lg hover:bg-yellow-600 transition duration-200">
                                    Edit
                                </a>

                                <!-- Delete Button -->
                                <form action="{{ route('admin.user.delete', $user->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus user ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-600 text-white px-3 py-1 rounded-lg hover:bg-red-700 transition duration-200">
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-6">
{{ $users->links() }}


    </div>
</div>
@endsection
