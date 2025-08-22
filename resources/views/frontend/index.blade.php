@extends('frontend.layouts.master')
@section('content')
    <!-- Posts List -->
    <div class="flex-grow container mx-auto my-8 px-4 flex flex-wrap -mx-3">
        <div class="w-full sm:w-1/2 md:w-1/3 px-3 mb-6">
            <div class="bg-gray-800 p-6 rounded-lg shadow-md hover:shadow-xl transition-shadow duration-300">
                <img src="https://via.placeholder.com/300x200" alt="Post Image"
                    class="w-full h-48 object-cover rounded-lg mb-4">
                <h2 class="text-xl font-semibold text-blue-300">Sample Post Title</h2>
                <p class="text-gray-400 text-sm">Category: Technology</p>
                <p class="text-gray-300 mt-2 line-clamp-3">This is a short summary of the blog post...</p>
                <a href="post.html" class="text-blue-400 hover:text-blue-300 transition-colors duration-200 mt-4 block">Read
                    More</a>
            </div>
        </div>
    </div>
@endsection
