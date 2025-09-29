
    <!-- عنوان داشبورد -->
    <h2 class="text-2xl font-semibold text-blue-300 mb-6">Dashboard</h2>

    <!-- کارت‌های آماری -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class="bg-gray-800 p-6 rounded-lg shadow-md flex items-center justify-between">
            <div>
                <h3 class="text-lg font-semibold text-gray-300">Posts</h3>
                <p class="text-2xl font-bold text-blue-400">{{ $posts->count() }}</p>
            </div>
            <i data-lucide="file-text" class="w-10 h-10 text-blue-400"></i>
        </div>
        <div class="bg-gray-800 p-6 rounded-lg shadow-md flex items-center justify-between">
            <div>
                <h3 class="text-lg font-semibold text-gray-300">Categories</h3>
                <p class="text-2xl font-bold text-green-400">{{ $categories->count() }}</p>
            </div>
            <i data-lucide="layers" class="w-10 h-10 text-green-400"></i>
        </div>
        <div class="bg-gray-800 p-6 rounded-lg shadow-md flex items-center justify-between">
            <div>
                <h3 class="text-lg font-semibold text-gray-300">Users</h3>
                <p class="text-2xl font-bold text-purple-400">{{ $users->count() }}</p>
            </div>
            <i data-lucide="users" class="w-10 h-10 text-purple-400"></i>
        </div>
        <div class="bg-gray-800 p-6 rounded-lg shadow-md flex items-center justify-between">
            <div>
                <h3 class="text-lg font-semibold text-gray-300">Comments</h3>
                <p class="text-2xl font-bold text-pink-400">{{ $comments->count() }}</p>
            </div>
            <i data-lucide="message-square" class="w-10 h-10 text-pink-400"></i>
        </div>
    </div>

    <!-- آخرین فعالیت‌ها -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- آخرین پست‌ها -->
        <div class="bg-gray-800 p-6 rounded-lg shadow-md">
            <h3 class="text-xl font-semibold text-blue-300 mb-4">Latest Posts</h3>
            <ul class="divide-y divide-gray-700">
                @foreach($posts->take(5) as $post)
                    <li class="py-2 flex justify-between">
                        <span>{{ $post->title }}</span>
                        <span class="text-sm text-gray-400">{{ $post->created_at->diffForHumans() }}</span>
                    </li>
                @endforeach
            </ul>
        </div>

        <!-- آخرین کامنت‌ها -->
        <div class="bg-gray-800 p-6 rounded-lg shadow-md">
            <h3 class="text-xl font-semibold text-blue-300 mb-4">Latest Comments</h3>
            <ul class="divide-y divide-gray-700">
                @foreach($comments->take(5) as $comment)
                    <li class="py-2">
                        <p class="text-gray-300">"{{ Str::limit($comment->content, 50) }}"</p>
                        <span class="text-sm text-gray-400">by {{ $comment->user->name }} - {{ $comment->created_at->diffForHumans() }}</span>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>