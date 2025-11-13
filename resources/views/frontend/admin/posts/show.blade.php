@extends('frontend.layouts.master')
@section('title', $post->title)
@section('content')
    @include('frontend.layouts.nav')
    <!-- Post Details -->
    <div class="container mx-auto my-8 px-4">
        @include('errors.message')
        <div class="bg-gray-800 p-8 rounded-lg shadow-md">
            <h1 class="text-3xl font-bold text-blue-300 mb-4">{{ $post->title }}</h1>
            <p class="text-gray-400 text-sm mb-4">{{ $post->category->name }}</p>
            <div class="w-full overflow-hidden rounded-xl mb-6">
                <img src="/{{ $post->image }}" alt="{{ $post->title }}"
                    class="w-full max-h-[450px] object-cover object-center rounded-xl transition-transform duration-500 hover:scale-105">
            </div>
            <p class="text-gray-200 leading-relaxed">{{ $post->content }}</p>
            <div class="flex flex-wrap items-center justify-between mt-6 border-t border-gray-700 pt-4">
                <!-- TAGS -->
                <div class="flex flex-wrap gap-2">
                    @forelse ($post->tags as $tag)
                        <a href="{{ route('post.byTag', $tag->name) }}"
                            class="bg-blue-700 hover:bg-blue-600 text-white text-sm px-3 py-1 rounded-full transition">
                            #{{ $tag->name }}
                        </a>
                    @empty
                        <span class="text-gray-400 text-sm">No tags</span>
                    @endforelse
                </div>

                <!-- LIKE BUTTON -->
                <button
                    class="like-btn flex items-center gap-1 transition duration-300 {{ auth()->check() && $post->isLikedBy(auth()->user()) ? 'text-pink-500' : 'text-gray-400' }}"
                    data-post-id="{{ $post->id }}" data-auth="{{ auth()->check() ? '1' : '0' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20" class="w-5 h-5">
                        <path
                            d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 18.343l-6.828-6.829a4 4 0 010-5.656z" />
                    </svg>
                    <span class="like-count">{{ $post->likesCount() }}</span>
                </button>
            </div>

        </div>
    </div>

    <!-- Comments -->
    <div class="container mx-auto px-4">
        <h2 class="text-2xl font-semibold text-blue-300 mb-4">Comments</h2>
        @foreach ($comments as $comment)
            <div class="bg-gray-800 p-6 rounded-lg shadow-md mb-6">
                <p class="text-gray-200">{{ $comment->comment }}</p>
                <p class="text-gray-400 text-sm">By {{ $comment->user->name }} | {{ $comment->created_at }}</p>
            </div>
        @endforeach
        <!-- Comment Form -->
        <form action="{{ route('post.comment', $post->id) }}" method="POST" class="bg-gray-800 p-6 rounded-lg shadow-md">
            @csrf
            <textarea name="comment" placeholder="Add your comment..."
                class="w-full p-3 bg-gray-700 border border-gray-600 rounded-lg text-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500 transition"></textarea>
            <button type="submit"
                class="bg-blue-600 hover:bg-blue-500 text-white p-3 rounded-lg mt-4 transition-colors duration-200">Submit
                Comment</button>
        </form>
    </div>
@endsection
