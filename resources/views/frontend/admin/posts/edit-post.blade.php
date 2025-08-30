@extends('frontend.layouts.master')
@section('title', 'edit post')
@section('content')
    <!-- Edit Post Form -->
    <div class="flex-grow container mx-auto my-8 px-4 flex flex-wrap -mx-3">
        <div class="container mx-auto my-8 px-4">
            <a href="/admin"
                class="bg-red-600 hover:bg-green-500 text-white p-3 rounded-lg transition-colors duration-200">Return to home
                page</a>
            <div class="bg-gray-800 p-8 rounded-lg shadow-md max-w-2xl mx-auto">
                @include('errors.message')
                <h2 class="text-2xl font-semibold text-blue-300 mb-6">Edit Post</h2>
                <form action="/admin/posts/<?= $post->id ?>/update" enctype="multipart/form-data" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-4">
                        <label for="title" class="block text-gray-300">Title</label>
                        <input type="text" name="title" id="title" value="{{ $post->title }}"
                            class="w-full p-3 bg-gray-700 border border-gray-600 rounded-lg text-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500 transition">
                    </div>
                    <div class="mb-4">
                        <label for="category" class="block text-gray-300">Category</label>
                        <select name="category_id" id="category"
                            class="w-full p-3 bg-gray-700 border border-gray-600 rounded-lg text-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500 transition">
                            <option value="{{ $post->category->id }}" selected>{{ $post->category->name }}</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-4">
                        <label for="content" class="block text-gray-300">Content</label>
                        <textarea name="content" id="content"
                            class="w-full p-3 bg-gray-700 border border-gray-600 rounded-lg text-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500 transition">{{ substr($post->content, 0, 20) }}</textarea>
                    </div>
                    <div class="mb-6">
                        <label for="image" class="block text-gray-300">Image</label>
                        <input type="file" name="image" id="image"
                            class="w-full p-3 bg-gray-700 border border-gray-600 rounded-lg text-gray-100">
                        <img src="/{{ $post->image }}" style="width: 100px">
                    </div>
                    <button type="submit"
                        class="bg-blue-600 hover:bg-blue-500 text-white p-3 rounded-lg transition-colors duration-200">Update
                        Post</button>
                </form>
            </div>
        </div>
    </div>
@endsection
