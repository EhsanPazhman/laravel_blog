<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Blog - Admin Panel')</title>
    <link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
</head>

<body class="bg-gray-900 text-gray-100 font-inter flex flex-col min-h-screen">
    <nav id="main-nav" class="bg-gradient-to-r from-blue-900 to-indigo-900 text-gray-100 shadow-lg fixed top-0 left-0 right-0 z-40 h-16 lg:h-20 flex items-center transition-all duration-300 ease-in-out md:ml-64 border-2 border-gray-700 rounded-t-none rounded-b-md">
        <div class="h-full container mx-auto px-4 flex items-center justify-between">
            <div class="flex items-center space-x-3 z-50">
                <button id="sidebarToggle" class="p-2 rounded-lg hover:bg-white hover:bg-opacity-20 transition-colors relative z-50">
                </button>
                <div class="flex items-center space-x-2 relative z-50">
                    <div class="w-8 h-8 bg-white bg-opacity-20 rounded-lg flex items-center justify-center">
                        <i data-lucide="feather" class="w-5 h-5"></i>
                    </div>
                    <h1 class="text-xl font-bold tracking-tight">Admin Panel</h1>
                </div>
            </div>
            <div class="flex items-center space-x-6 relative z-50">
                <a href="/" class="flex items-center gap-2 hover:text-blue-300 transition-colors">
                    <i data-lucide="home" class="w-4 h-4"></i>
                    <span class="hidden sm:inline">Home</span>
                </a>
                <a href="{{ route('admin.logout') }}" class="flex items-center gap-2 hover:text-blue-300 transition-colors">
                    <i data-lucide="log-out" class="w-4 h-4"></i>
                    <span class="hidden sm:inline">Logout</span>
                </a>
            </div>
        </div>
    </nav>
    <div class="h-16 lg:h-20"></div>