@extends('layouts.app')

@section('title', $berita->title)

@section('content')
    <div class="bg-white p-6 rounded-lg shadow-lg">
        <h2 class="text-2xl font-bold mb-6">{{ $berita->judul }}</h2>
        <p class="text-sm text-gray-600">{{ $berita->created_at->format('d-m-Y') }}</p>
        <img src="{{ asset('storage/' . $berita->gambar) }}" alt="{{ $berita->judul }}" class="w-full object-contain mb-4">
        <div class="mt-4 text-gray-700">
            {!! nl2br(e($berita->isi)) !!}
        </div>

        <div class="mt-6">
            @auth
                <!-- Comment and Rating Section for Authenticated Users -->
                <div class="space-y-4">
                    <h3 class="text-xl font-semibold">Comments and Ratings</h3>

                    <!-- Comment Form -->
                    <form action="{{ route('user.addComment', ['id'=> $berita->id]) }}" method="POST">
                    @csrf
                    <textarea name="komentar" id="komentar" nama="popi" class="w-full p-4 border border-gray-300 rounded-md" placeholder="Add your comment here..."></textarea>
                    <button type="submit" class="bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 mt-2">Submit Comment</button>
                    </form>

                    <!-- Rating Form -->
                    <form method="POST" action="{{ Route('user.addRating', ['id'=>$berita->id]) }}" class="mt-4">
                    @csrf
                    <label for="rating" class="block text-sm font-semibold">Rate this article:</label>
                    <select name="rating" id="rating" class="border border-gray-300 rounded-md w-1/3">
                        <option value="1">1 - Poor</option>
                        <option value="2">2 - Fair</option>
                        <option value="3">3 - Good</option>
                        <option value="4">4 - Very Good</option>
                        <option value="5">5 - Excellent</option>
                    </select>
                    <button type="submit" class="bg-yellow-500 text-white py-2 px-4 rounded-md hover:bg-yellow-600 mt-2">Submit Rating</button>
                </form>
                </div>
            @endauth

            <!-- Comments Section -->
            <div class="mt-8">
                <h3 class="text-xl font-semibold">User Comments</h3>
                @if($berita->komentar->isNotEmpty())
                    @foreach($berita->komentar as $comment)
                        <div class="mt-4 p-4 border border-gray-200 rounded-md">
                            <p><strong>{{ $comment->user->name }}</strong>: {{ $comment->komentar }}</p>
                        </div>
                    @endforeach
                @else
                    <p>No comments yet.</p>
                @endif
            </div>

            <!-- Ratings Section -->
            <div class="mt-8">
                <h3 class="text-xl font-semibold">User Ratings</h3>
                @if($berita->rating->isNotEmpty())
                    <p>Average Rating: {{ $berita->rating->avg('rating') ?? 'No ratings yet' }}</p>
                @else
                    <p>No ratings yet.</p>
                @endif
            </div>
        </div>
    </div>
@endsection
