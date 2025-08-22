@extends('frontend.admin.layouts.master')
@section('content')
        <!-- Admin Panel -->
    <div class="container mx-auto my-8 px-4">
        <h2 class="text-2xl font-semibold text-blue-300 mb-6">Admin Panel</h2>
        <!-- Manage Posts -->
        <div class="bg-gray-800 p-8 rounded-lg shadow-md mb-8">
            <h3 class="text-xl font-semibold text-blue-300 mb-4">Manage Posts</h3>
            <a href="add-post.html" class="bg-blue-600 hover:bg-blue-500 text-white p-3 rounded-lg mb-4 inline-block transition-colors duration-200">Add New Post</a>
            <table class="w-full border border-gray-700 rounded-lg">
                <thead>
                    <tr class="bg-gray-700">
                        <th class="p-3 text-left">Title</th>
                        <th class="p-3 text-left">Category</th>
                        <th class="p-3 text-left">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="hover:bg-gray-700 transition-colors duration-200">
                        <td class="p-3">Sample Post</td>
                        <td class="p-3">Technology</td>
                        <td class="p-3">
                            <a href="edit-post.html" class="text-blue-400 hover:text-blue-300 transition-colors duration-200">Edit</a>
                            <a href="#" class="text-red-400 hover:text-red-300 transition-colors duration-200 ml-2">Delete</a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <!-- Manage Categories -->
        <div class="bg-gray-800 p-8 rounded-lg shadow-md">
            <h3 class="text-xl font-semibold text-blue-300 mb-4">Manage Categories</h3>
            <a href="add-category.html" class="bg-blue-600 hover:bg-blue-500 text-white p-3 rounded-lg mb-4 inline-block transition-colors duration-200">Add New Category</a>
            <table class="w-full border border-gray-700 rounded-lg">
                <thead>
                    <tr class="bg-gray-700">
                        <th class="p-3 text-left">Name</th>
                        <th class="p-3 text-left">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="hover:bg-gray-700 transition-colors duration-200">
                        <td class="p-3">Technology</td>
                        <td class="p-3">
                            <a href="edit-category.html" class="text-blue-400 hover:text-blue-300 transition-colors duration-200">Edit</a>
                            <a href="#" class="text-red-400 hover:text-red-300 transition-colors duration-200 ml-2">Delete</a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection
