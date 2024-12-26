@extends('layouts.app')

@section('title', 'Edit Berita')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4 text-center">Edit Berita</h1>

    {{-- Flash Message Success --}}
    @if (session('success'))
        <div class="bg-green-500 text-white p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    {{-- Validation Errors --}}
    @if ($errors->any())
        <div class="bg-red-500 text-white p-3 rounded mb-4">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Form --}}
    <form action="{{ route('admin.beritas.update', $berita->id) }}" method="POST" enctype="multipart/form-data" class="space-y-4 bg-white shadow-lg p-6 rounded">
        @csrf
        @method('PUT')

        {{-- Judul --}}
        <div>
            <label for="judul" class="block text-sm font-medium" aria-label="Judul">Judul</label>
            <input
                type="text"
                id="judul"
                name="judul"
                value="{{ old('judul', $berita->judul) }}"
                class="w-full border border-gray-300 rounded p-2"
                required>
        </div>

        {{-- Isi --}}
        <div>
            <label for="isi" class="block text-sm font-medium" aria-label="Isi Berita">Isi</label>
            <textarea
                id="isi"
                name="isi"
                rows="5"
                class="w-full border border-gray-300 rounded p-2"
                required>{{ old('isi', $berita->isi) }}</textarea>
        </div>

        {{-- Gambar --}}
        <div>
            <label for="gambar" class="block text-sm font-medium" aria-label="Upload Gambar">Gambar</label>
            <input
                type="file"
                id="gambar"
                name="gambar"
                class="block w-full text-sm text-gray-900 border border-gray-300 rounded cursor-pointer bg-gray-50"
                accept="image/*">

            @if ($berita->gambar)
                <p class="mt-2 text-sm text-gray-600">Gambar saat ini:</p>
                <img src="{{ asset('storage/' . $berita->gambar) }}" alt="Gambar Berita" class="h-24 w-auto mt-2 rounded shadow">
            @else
                <p class="mt-2 text-sm text-gray-500">Tidak ada gambar yang diunggah.</p>
            @endif
        </div>

        {{-- Kategori --}}
        <div>
            <label for="kategori_id" class="block text-sm font-medium" aria-label="Pilih Kategori">Kategori</label>
            <select
                id="kategori_id"
                name="kategori_id[]"
                class="w-full border border-gray-300 rounded p-2"
                multiple required>
                @foreach ($kategori as $kategoriItem)
                    <option value="{{ $kategoriItem->id }}"
                        {{ in_array($kategoriItem->id, $berita->kategori ? $berita->kategori->pluck('id')->toArray() : []) ? 'selected' : '' }}>
                        {{ $kategoriItem->nama_kategori }}
                    </option>
                @endforeach
            </select>
            <p class="text-sm text-gray-500 mt-2">Tahan tombol <b>CTRL</b> (atau <b>CMD</b> di Mac) untuk memilih beberapa kategori.</p>
        </div>

        {{-- Submit Button --}}
        <div class="flex justify-end">
            <button
                type="submit"
                class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
                Update Berita
            </button>
        </div>
    </form>
</div>
@endsection
