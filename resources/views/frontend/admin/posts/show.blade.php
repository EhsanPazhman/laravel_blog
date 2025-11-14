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

        <!-- MAIN COMMENT FORM -->
        <form action="{{ route('post.comment', $post->id) }}" method="POST"
            class="bg-gray-800 p-6 rounded-lg shadow-md mb-6">
            @csrf
            <textarea name="comment" placeholder="Add your comment..."
                class="w-full p-3 bg-gray-700 border border-gray-600 rounded-lg text-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500 transition"></textarea>
            <button type="submit"
                class="bg-blue-600 hover:bg-blue-500 text-white p-3 rounded-lg mt-4 transition-colors duration-200">Submit
                Comment</button>
        </form>

        <!-- LIST OF COMMENTS -->
        @foreach ($comments->where('parent_id', null) as $comment)
            @if ($comment->status === 'approved')
                <div class="bg-gray-800 p-6 rounded-lg shadow-md mb-4">
                    <p class="text-gray-200">{{ $comment->comment }}</p>
                    <p class="text-gray-400 text-sm">By {{ $comment->user->name }} | {{ $comment->created_at }}</p>

                    <!-- REPLY BUTTON & FORM -->
                    <button class="reply-btn text-blue-400 mt-2" data-comment-id="{{ $comment->id }}">Reply</button>
                    <form action="{{ route('post.comment', $post->id) }}" method="POST" class="reply-form hidden mt-2">
                        @csrf
                        <input type="hidden" name="parent_id" value="{{ $comment->id }}">
                        <textarea name="comment" placeholder="Write a reply..."
                            class="w-full p-2 bg-gray-700 border border-gray-600 rounded-lg text-gray-100 focus:outline-none"></textarea>
                        <button type="submit" class="bg-blue-600 hover:bg-blue-500 text-white p-2 rounded-lg mt-2">Submit
                            Reply</button>
                    </form>

                    <!-- LIST OF REPLIES -->
                    @foreach ($comment->replies as $reply)
                        @if ($reply->status === 'approved')
                            <div class="bg-gray-700 p-4 rounded-lg mt-2 ml-6">
                                <p class="text-gray-200">{{ $reply->comment }}</p>
                                <p class="text-gray-400 text-sm">By {{ $reply->user->name }} | {{ $reply->created_at }}
                                </p>
                            </div>
                        @endif
                    @endforeach
                </div>
            @endif
        @endforeach
    </div>

    <!-- JS TOGGLE REPLY FORM -->
    <script>
        document.querySelectorAll('.reply-btn').forEach(btn => {
            btn.addEventListener('click', () => {
                const form = btn.nextElementSibling;
                form.classList.toggle('hidden');
            });
        });
    </script>

@endsection
