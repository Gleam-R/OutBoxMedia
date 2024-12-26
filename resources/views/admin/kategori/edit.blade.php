@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-6 py-8">
        <h1 class="text-3xl font-semibold text-gray-800 mb-6">Edit Kategori</h1>

        <form action="{{ route('admin.editKategori', $kategori->id) }}" method="POST" class="bg-white p-6 rounded-lg shadow-lg">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="nama_kategori" class="block text-gray-700 text-sm font-medium mb-2">Nama Kategori</label>
                <input type="text" id="nama_kategori" name="nama_kategori"
                       class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-orange-600 focus:border-orange-600"
                       required value="{{ old('nama_kategori', $kategori->nama_kategori) }}" placeholder="Masukkan Nama Kategori">

                @error('nama_kategori')
                    <div class="mt-2 text-red-600 text-sm">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="w-full bg-orange-600 text-white py-2 rounded-md hover:bg-orange-700 transition-colors duration-200">
                Update Kategori
            </button>
        </form>
    </div>
@endsection
