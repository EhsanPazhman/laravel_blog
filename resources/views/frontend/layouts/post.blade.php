@extends('frontend.layouts.master')
@section('title', $post->title)
@section('content')
@include('frontend.layouts.nav')
    <!-- Post Details -->
    <div class="container mx-auto my-8 px-4">
        <div class="bg-gray-800 p-8 rounded-lg shadow-md">
            <h1 class="text-3xl font-bold text-blue-300 mb-4">{{ $post->title }}</h1>
            <p class="text-gray-400 text-sm mb-4">{{ $post->category->name }}</p>
            <img src="/{{ $post->image }}" alt="Post Image" class="w-full h-64 object-cover rounded-lg mb-6">
            <p class="text-gray-200 leading-relaxed">{{ $post->content }}</p>
        </div>
    </div>

    <!-- Comments -->
    <div class="container mx-auto px-4">
        <h2 class="text-2xl font-semibold text-blue-300 mb-4">Comments</h2>
        <div class="bg-gray-800 p-6 rounded-lg shadow-md mb-6">
            <p class="text-gray-200">Great post!</p>
            <p class="text-gray-400 text-sm">By User123 | 2025-08-17</p>
        </div>
        <!-- Comment Form -->
        <form action="post.html" method="POST" class="bg-gray-800 p-6 rounded-lg shadow-md">
            <textarea name="comment" placeholder="Add your comment..." class="w-full p-3 bg-gray-700 border border-gray-600 rounded-lg text-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500 transition" required></textarea>
            <button type="submit" class="bg-blue-600 hover:bg-blue-500 text-white p-3 rounded-lg mt-4 transition-colors duration-200">Submit Comment</button>
        </form>
    </div>
@endsection
