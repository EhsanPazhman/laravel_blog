@extends('frontend.layouts.master')
@section('content')
    <!-- Login Form -->
    <div class="flex-grow container mx-auto my-8 px-4">
        <div class="bg-gray-800 p-8 rounded-lg shadow-md max-w-md mx-auto">
            @include('errors.message')
            <h2 class="text-2xl font-semibold text-blue-300 mb-6">Login</h2>
            <form action="{{ route('login') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="email" class="block text-gray-300">Email</label>
                    <input type="email" name="email" id="email"
                        class="w-full p-3 bg-gray-700 border border-gray-600 rounded-lg text-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500 transition"
                        required>
                </div>
                <div class="mb-6">
                    <label for="password" class="block text-gray-300">Password</label>
                    <input type="password" name="password" id="password"
                        class="w-full p-3 bg-gray-700 border border-gray-600 rounded-lg text-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500 transition"
                        required>
                </div>
                <button type="submit"
                    class="bg-blue-600 hover:bg-blue-500 text-white p-3 rounded-lg w-full transition-colors duration-200">Login</button>
            </form>
        </div>
    </div>
@endsection
