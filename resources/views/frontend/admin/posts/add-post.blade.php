@extends('frontend.layouts.master')
@section('content')
    <!-- Navigation -->
    <div class="flex-grow container mx-auto my-8 px-4 flex flex-wrap -mx-3">
        <nav class="bg-gradient-to-r from-blue-700 to-purple-600 text-white p-6 shadow-lg">
            <div class="container mx-auto flex justify-between items-center">
                <h1 class="text-3xl font-bold tracking-tight">My Blog - Admin</h1>
                <div class="space-x-6">
                    <a href="index.html" class="hover:text-blue-300 transition-colors duration-200">Home</a>
                    <a href="admin.html" class="hover:text-blue-300 transition-colors duration-200">Admin Panel</a>
                    <a href="login.html" class="hover:text-blue-300 transition-colors duration-200">Logout</a>
                </div>
            </div>
        </nav>

        <!-- Add Post Form -->
        <div class="container mx-auto my-8 px-4">
            <div class="bg-gray-800 p-8 rounded-lg shadow-md max-w-2xl mx-auto">
                <h2 class="text-2xl font-semibold text-blue-300 mb-6">Add New Post</h2>
                <form action="add-post.html" method="POST" enctype="multipart/form-data">
                    <div class="mb-4">
                        <label for="title" class="block text-gray-300">Title</label>
                        <input type="text" name="title" id="title"
                            class="w-full p-3 bg-gray-700 border border-gray-600 rounded-lg text-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500 transition"
                            required>
                    </div>
                    <div class="mb-4">
                        <label for="category" class="block text-gray-300">Category</label>
                        <select name="category" id="category"
                            class="w-full p-3 bg-gray-700 border border-gray-600 rounded-lg text-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500 transition"
                            required>
                            <option value="">Select Category</option>
                            <option value="tech">Technology</option>
                            <option value="lifestyle">Lifestyle</option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label for="content" class="block text-gray-300">Content</label>
                        <textarea name="content" id="content"
                            class="w-full p-3 bg-gray-700 border border-gray-600 rounded-lg text-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500 transition"
                            required></textarea>
                    </div>
                    <div class="mb-6">
                        <label for="image" class="block text-gray-300">Image</label>
                        <input type="file" name="image" id="image"
                            class="w-full p-3 bg-gray-700 border border-gray-600 rounded-lg text-gray-100">
                    </div>
                    <button type="submit"
                        class="bg-blue-600 hover:bg-blue-500 text-white p-3 rounded-lg transition-colors duration-200">Add
                        Post</button>
                </form>
            </div>
        </div>
    </div>
@endsection
