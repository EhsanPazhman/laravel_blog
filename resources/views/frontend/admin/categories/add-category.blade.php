@extends('frontend.layouts.master')
@section('content')
    <!-- Add Category Form -->
    <div class="flex-grow container mx-auto my-8 px-4 flex flex-wrap -mx-3">
        <div class="container mx-auto my-8 px-4">
            <a href="/admin" class="bg-red-600 hover:bg-green-500 text-white p-3 rounded-lg transition-colors duration-200">Return to home page</a>
            <div class="bg-gray-800 p-8 rounded-lg shadow-md max-w-md mx-auto">
            @include('errors.message')
                <h2 class="text-2xl font-semibold text-blue-300 mb-6">Add New Category</h2>
                <form action="/admin/categories/store" method="POST">
                    @csrf
                    <div class="mb-6">
                        <label for="name" class="block text-gray-300">Category Name</label>
                        <input type="text" name="name" id="name"
                            class="w-full p-3 bg-gray-700 border border-gray-600 rounded-lg text-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500 transition"
                            required>
                    </div>
                    <div class="mb-6">
                        <label for="slug" class="block text-gray-300">Category Slug</label>
                        <input type="text" name="slug" id="slug"
                            class="w-full p-3 bg-gray-700 border border-gray-600 rounded-lg text-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500 transition"
                            required>
                    </div>
                    <button type="submit"
                        class="bg-blue-600 hover:bg-blue-500 text-white p-3 rounded-lg transition-colors duration-200">Add
                        Category</button>
                </form>
            </div>
        </div>
    </div>
@endsection
