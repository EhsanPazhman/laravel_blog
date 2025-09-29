<aside id="sidebar" class="fixed left-0 z-30 bg-gray-800 text-white shadow-xl transition-all duration-300 ease-in-out h-screen w-64 -translate-x-full border-2 border-gray-700 rounded-tr-none rounded-md">
    <div class="h-16 bg-gray-800 border-b border-gray-700 flex items-center px-4">
        <div class="flex items-center">
            <div class="w-8 h-8 bg-gradient-to-r from-blue-500 to-purple-600 rounded-lg flex items-center justify-center">
                <i data-lucide="layout-dashboard" class="w-4 h-4 text-white"></i>
            </div>
            <h2 class="ml-3 text-xl font-bold text-white">Admin Panel</h2>
        </div>
    </div>
    <nav class="flex-1 overflow-y-auto px-4 py-4">
        <ul class="space-y-1">
            <li>
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 p-3 rounded-lg text-gray-300 hover:bg-gray-700 transition-all group {{ request()->routeIs('admin.dashboard') ? 'bg-blue-600 text-white' : '' }}">
                    <i data-lucide="home" class="w-5 h-5"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.users.index') }}" class="flex items-center gap-3 p-3 rounded-lg text-gray-300 hover:bg-gray-700 transition-all group {{ request()->routeIs('admin.users.*') ? 'bg-blue-600 text-white' : '' }}">
                    <i data-lucide="users" class="w-5 h-5"></i>
                    <span>Users</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.posts.index') }}" class="flex items-center gap-3 p-3 rounded-lg text-gray-300 hover:bg-gray-700 transition-all group {{ request()->routeIs('admin.posts.*') ? 'bg-blue-600 text-white' : '' }}">
                    <i data-lucide="file-text" class="w-5 h-5"></i>
                    <span>Posts</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.categories.index') }}" class="flex items-center gap-3 p-3 rounded-lg text-gray-300 hover:bg-gray-700 transition-all group {{ request()->routeIs('admin.categories.*') ? 'bg-blue-600 text-white' : '' }}">
                    <i data-lucide="layers" class="w-5 h-5"></i>
                    <span>Categories</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.comments.index') }}" class="flex items-center gap-3 p-3 rounded-lg text-gray-300 hover:bg-gray-700 transition-all group {{ request()->routeIs('admin.comments.*') ? 'bg-blue-600 text-white' : '' }}">
                    <i data-lucide="message-square" class="w-5 h-5"></i>
                    <span>Comments</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.settings') }}" class="flex items-center gap-3 p-3 rounded-lg text-gray-300 hover:bg-gray-700 transition-all group {{ request()->routeIs('admin.settings') ? 'bg-blue-600 text-white' : '' }}">
                    <i data-lucide="settings" class="w-5 h-5"></i>
                    <span>Settings</span>
                </a>
            </li>
            <li>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="w-full flex items-center gap-3 p-3 rounded-lg text-gray-300 hover:bg-red-600 hover:text-white transition-all group">
                        <i data-lucide="log-out" class="w-5 h-5"></i>
                        <span>Logout</span>
                    </button>
                </form>
            </li>
        </ul>
    </nav>
    <div class="border-t border-gray-700 p-4 bg-gray-800">
        <div class="bg-gray-700 p-3 rounded-lg flex items-center space-x-3">
            <div class="w-8 h-8 bg-gradient-to-r from-blue-500 to-purple-600 rounded-full flex items-center justify-center">
                <i data-lucide="user" class="w-4 h-4 text-white"></i>
            </div>
            <div class="min-w-0 flex-1">
                <p class="text-sm font-medium text-white truncate">{{ Auth::user()->name ?? 'Admin' }}</p>
                <p class="text-xs text-gray-400 truncate">{{ Str::limit(Auth::user()->email ?? 'admin@example.com', 20) }}</p>
            </div>
        </div>
    </div>
</aside>
<div id="overlay" class="fixed inset-0 bg-black bg-opacity-50 hidden z-40 md:hidden transition-opacity duration-300"></div>