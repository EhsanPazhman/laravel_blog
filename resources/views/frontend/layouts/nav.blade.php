        <!-- Search and Filter -->
    <div class="container mx-auto my-8 px-4">
        <div class="flex flex-col md:flex-row justify-between items-center gap-4 mb-8">
            <form action="index.html" method="GET" class="w-full md:w-1/2">
                <input type="text" name="search" placeholder="Search posts..." class="w-full p-3 bg-gray-800 border border-gray-700 rounded-lg text-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500 transition">
            </form>
            <form action="index.html" method="GET">
                <select name="category" class="p-3 bg-gray-800 border border-gray-700 rounded-lg text-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500 transition">
                    <option value="">All Categories</option>
                    @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </form>
        </div>
    </div>