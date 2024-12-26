@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-6 py-8">
        <h1 class="text-3xl font-semibold text-gray-800 mb-6">Daftar Kategori</h1>

        <a href="{{ route('admin.addKategoriForm') }}"
           class="bg-orange-600 text-white py-2 px-4 rounded-md hover:bg-purple-700 transition-colors duration-200 mb-6 inline-block">
            Tambah Kategori
        </a>

        @if(session('success'))
            <div class="alert alert-success mb-4 bg-green-100 text-green-800 p-4 rounded-md">
                {{ session('success') }}
            </div>
        @endif

        <div class="overflow-x-auto bg-white shadow-lg rounded-lg">
            <table class="min-w-full table-auto">
                <thead class="bg-orange-600 text-white">
                    <tr>
                        <th class="px-6 py-4 text-left text-sm font-medium">#</th>
                        <th class="px-6 py-4 text-left text-sm font-medium">Nama Kategori</th>
                        <th class="px-6 py-4 text-left text-sm font-medium">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($kategori as $k)
                        <tr class="border-t hover:bg-gray-100 transition-colors duration-200">
                            <td class="px-6 py-4 text-sm">{{ $loop->iteration }}</td>
                            <td class="px-6 py-4 text-sm">{{ $k->nama_kategori }}</td>
                            <td class="px-6 py-4 text-sm">
                                <div class="flex space-x-2">
                                    <a href="{{ route('admin.editKategoriForm', $k->id) }}"
                                       class="bg-yellow-500 text-white py-1 px-3 rounded-md hover:bg-yellow-600 transition-colors duration-200">
                                        Edit
                                    </a>
                                    <form action="{{ route('admin.deleteKategori', $k->id) }}" method="POST"
                                          onsubmit="return confirm('Are you sure you want to delete this item?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="bg-red-500 text-white py-1 px-3 rounded-md hover:bg-red-600 transition-colors duration-200">
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
    </div>
@endsection
