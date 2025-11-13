@extends('frontend.layouts.master')
@section('content')
    @include('frontend.layouts.nav')
    <!-- Posts List -->
    <div class="flex-grow container mx-auto my-8 px-4 flex flex-wrap -mx-3">
        @forelse ($posts as $post)
            <div class="w-full sm:w-1/2 md:w-1/3 px-3 mb-6">
                <div
                    class="group bg-gray-800 rounded-2xl shadow-md hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2 overflow-hidden relative">

                    <!-- IMAGE -->
                    <div class="overflow-hidden rounded-t-2xl">
                        <img src="{{ asset($post->image) }}" alt="{{ $post->title }}"
                            class="w-full h-48 object-cover transition-transform duration-500 group-hover:scale-110">
                    </div>

                    <!-- CONTENT -->
                    <div class="p-6">
                        <h2
                            class="text-xl font-semibold text-blue-300 group-hover:text-blue-400 transition-colors duration-300">
                            {{ $post->title }}
                        </h2>
                        <p class="text-gray-400 text-sm mb-2">Category: {{ $post->category->name }}</p>
                        <p class="text-gray-300 mb-4 line-clamp-3 group-hover:text-gray-100 transition-colors duration-300">
                            {{ Str::limit($post->content, 80) }}
                        </p>

                        <!-- READ MORE -->
                        <a href="{{ route('post.show', $post->slug) }}"
                            class="text-blue-400 hover:text-blue-300 transition-all duration-300 font-medium inline-flex items-center gap-1">
                            Read More
                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="h-4 w-4 transition-transform duration-300 group-hover:translate-x-1" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 7l5 5m0 0l-5 5m5-5H6" />
                            </svg>
                        </a>

                        <!-- TAGS + LIKE -->
                        <div class="flex items-center justify-between mt-5 border-t border-gray-700 pt-3">
                            <!-- Tags -->
                            <div class="flex flex-wrap gap-2">
                                @if ($post->tags && $post->tags->count())
                                    @foreach ($post->tags as $tag)
                                        <span
                                            class="text-xs px-2 py-1 rounded-full bg-gray-700 text-gray-200 hover:bg-blue-600 hover:text-white transition-colors duration-300 cursor-pointer">
                                            #{{ $tag->name }}
                                        </span>
                                    @endforeach
                                @endif
                            </div>

                            <!-- Like Button -->
                            <button
                                class="like-btn flex items-center gap-1 transition duration-300 {{ auth()->check() && $post->isLikedBy(auth()->user()) ? 'text-pink-500' : 'text-gray-400' }}"
                                data-post-id="{{ $post->id }}" data-auth="{{ auth()->check() ? '1' : '0' }}">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20"
                                    class="w-5 h-5">
                                    <path
                                        d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 18.657l-6.828-6.829a4 4 0 010-5.656z" />
                                </svg>
                                <span class="like-count text-sm">{{ $post->likesCount() }}</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="w-full text-center py-10">
                <p class="text-gray-400 text-lg">
                    😕 No posts found.
                </p>
            </div>
        @endforelse
    </div>
@endsection
