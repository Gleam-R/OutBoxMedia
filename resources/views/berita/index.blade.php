@extends('layouts.app')

@section('title', 'Berita')

@section('content')
    <div class="bg-white p-6 rounded-lg shadow-lg">
        <h2 class="text-2xl font-bold mb-6">Berita</h2>

        <!-- Check if user is authenticated -->
        @auth
            @if(Auth::user()->role == 'admin')
                <!-- Admin: Manage Berita -->
                <a href="{{ url('/admin/berita/create') }}"
                   class="bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 mb-4 inline-block">
                    Add New Berita
                </a>
                <table class="min-w-full table-auto">
                    <thead>
                        <tr>
                            <th class="px-4 py-2 text-left">No</th>
                            <th class="px-4 py-2 text-left">Title</th>
                            <th class="px-4 py-2 text-left">Categories</th>
                            <th class="px-4 py-2 text-left">Published</th>
                            <th class="px-4 py-2 text-left">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($beritas->count() > 0)
                            @foreach($beritas as $key => $berita)
                                <tr class="border-t">
                                    <td class="px-4 py-2">{{ $key + 1 }}</td>
                                    <td class="px-4 py-2">{{ $berita->judul }}</td>
                                    <td class="px-4 py-2">
                                        @foreach($berita->kategori as $kategori)
                                            <span class="bg-blue-100 text-blue-600 py-1 px-2 rounded-md text-xs">
                                                {{ $kategori->nama_kategori }}
                                            </span>
                                        @endforeach
                                    </td>
                                    <td class="px-4 py-2">{{ $berita->created_at->format('d-m-Y') }}</td>
                                    <td class="px-4 py-2 flex space-x-2">
                                        <a href="{{ url('/admin/berita/' . $berita->id . '/edit') }}"
                                           class="bg-yellow-500 text-white py-1 px-3 rounded-md hover:bg-yellow-600">
                                            Edit
                                        </a>
                                        <form action="{{ url('/admin/berita/' . $berita->id) }}"
                                              method="POST"
                                              onsubmit="return confirm('Are you sure you want to delete this item?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="bg-red-500 text-white py-1 px-3 rounded-md hover:bg-red-600">
                                                Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="5" class="text-center py-4">No Berita available.</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
                <div class="mt-4">
                    {{ $beritas->links() }}
                </div>
            @else
                <!-- User: Show News List -->
                <div class="space-y-4">
                    @foreach($beritas as $berita)
                        <div class="border-b py-4">
                            <a href="{{ url('/berita/' . $berita->id) }}"
                               class="text-blue-600 hover:underline text-lg font-semibold">
                                {{ $berita->judul }}
                            </a>
                            <p class="text-sm text-gray-600">{{ $berita->created_at->format('d-m-Y') }}</p>
                            <p class="text-gray-700">{{ Str::limit($berita->isi, 150) }}...</p>
                        </div>
                    @endforeach
                </div>
                <div class="mt-4">
                    {{ $beritas->links() }}
                </div>
            @endif
        @else
            <!-- Guest: Show News List -->
            <div class="space-y-4">
                @foreach($beritas as $berita)
                    <div class="border-b py-4">
                        <a href="{{ url('/berita/' . $berita->id) }}"
                           class="text-blue-600 hover:underline text-lg font-semibold">
                            {{ $berita->judul }}
                        </a>
                        <p class="text-sm text-gray-600">{{ $berita->created_at->format('d-m-Y') }}</p>
                        <p class="text-gray-700">{{ Str::limit($berita->isi, 150) }}...</p>
                    </div>
                @endforeach
            </div>
            <div class="mt-4">
                {{ $beritas->links() }}
            </div>
        @endauth
    </div>
@endsection
