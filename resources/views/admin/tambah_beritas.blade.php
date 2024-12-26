@extends('layouts.app')

@section('title', 'Tambah Berita')

@section('content')
    <div class="bg-white p-6 rounded-lg shadow-lg">
        <h2 class="text-2xl font-bold mb-6">Tambah Berita</h2>

        <form action="{{ route('addberitas') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-4">
                <label for="judul" class="block text-sm font-medium text-gray-700">Judul</label>
                <input type="text" id="judul" name="judul" value="{{ old('judul') }}" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" required>
                @error('judul') <div class="mt-1 text-red-500 text-sm">{{ $message }}</div> @enderror
            </div>

            <div class="mb-4">
                <label for="isi" class="block text-sm font-medium text-gray-700">Konten</label>
                <textarea id="isi" name="isi" rows="5" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" required>{{ old('isi') }}</textarea>
                @error('isi') <div class="mt-1 text-red-500 text-sm">{{ $message }}</div> @enderror
            </div>

            <div class="mb-4">
                <label for="gambar" class="block text-sm font-medium text-gray-700">Gambar</label>
                <input type="file" id="gambar" name="gambar" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" required>
                @error('gambar') <div class="mt-1 text-red-500 text-sm">{{ $message }}</div> @enderror
            </div>

            <div class="mb-4">
                <label for="kategori_id" class="block text-sm font-medium text-gray-700">Kategori</label>
                <select id="kategori_id" name="kategori_id[]" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" multiple required>
                    @foreach($kategori as $kategori)
                        <option value="{{ $kategori->id }}" {{ (is_array(old('kategori_id')) && in_array($kategori->id, old('kategori_id'))) ? 'selected' : '' }}>
                            {{ $kategori->nama_kategori }}
                        </option>
                    @endforeach
                </select>
                @error('kategori_id') <div class="mt-1 text-red-500 text-sm">{{ $message }}</div> @enderror
            </div>

            <div>
                <button type="submit" class="bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700">
                    Simpan Berita
                </button>
            </div>
        </form>
    </div>
@endsection
