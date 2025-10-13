@extends('frontend.layouts.master')
@section('content')
@include('frontend.layouts.nav')
    <!-- Posts List -->
    <div class="flex-grow container mx-auto my-8 px-4 flex flex-wrap -mx-3">
            @forelse ($posts as $post)
        <div class="w-full sm:w-1/2 md:w-1/3 px-3 mb-6">
                <div class="bg-gray-800 p-6 rounded-lg shadow-md hover:shadow-xl transition-shadow duration-300">
                        <img src="{{ asset($post->image) }}" alt="{{ $post->title }}"
                        class="w-full h-48 object-cover rounded-lg mb-4">

                    <h2 class="text-xl font-semibold text-blue-300">{{ $post->title }}</h2>
                    <p class="text-gray-400 text-sm">Category: {{ $post->category->name }}</p>
                    <p class="text-gray-300 mt-2 line-clamp-3">{{ substr($post->content, 0, 20) }}</p>
                    <a href="{{ route('post.show', $post->slug) }}"
                        class="text-blue-400 hover:text-blue-300 transition-colors duration-200 mt-4 block">Read
                        More</a>
                </div>
        </div>
            @empty
        <div class="w-full text-center py-10">
            <p class="text-gray-400 text-lg">
                😕 No posts found for this category.
            </p>
        </div>
            @endforelse
    </div>
@endsection
