<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Blog - Home')</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
</head>

<body class="flex flex-col min-h-screen bg-gray-900 text-gray-100 font-inter">
    <!-- Navigation -->
    <nav class="bg-gradient-to-r from-blue-700 to-purple-600 text-white p-6 shadow-lg">
        <div class="container mx-auto flex justify-between items-center">
            <h1 class="text-3xl font-bold tracking-tight">My Blog</h1>
            <div class="space-x-6">
                <a href="/" class="hover:text-blue-300 transition-colors duration-200">Home</a>
                @auth
                    @if (auth()->user()->role == 'admin')
                        <a href="/admin" class="hover:text-blue-300 transition-colors duration-200">Admin Panel</a>
                    @endif
                    <form action="/logout" method="POST" style="display:inline;">
                        @csrf
                        <button type="submit">Logout</button>
                    </form>
                @else
                    <a href="/login" class="hover:text-blue-300 transition-colors duration-200">Login</a>
                    <a href="/register" class="hover:text-blue-300 transition-colors duration-200">Register</a>
                @endauth
            </div>
        </div>
    </nav>
