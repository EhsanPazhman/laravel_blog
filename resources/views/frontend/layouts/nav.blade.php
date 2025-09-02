        <!-- Search and Filter -->
        <div class="container mx-auto my-8 px-4">
            <div class="flex flex-col md:flex-row justify-between items-center gap-4 mb-8">
                <form action="{{ route('post.search') }}" method="GET" class="w-full md:w-1/4">
                    @csrf
                    <input id="searchInput" type="text" name="search" placeholder="Search posts..."
                        class="w-full p-3 bg-gray-800 border border-gray-700 rounded-lg text-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500 transition">
                    <div id="searchResults"
                        class="md:w-1/4 p-5  absolute mt-2 bg-gray-900 border border-gray-700 rounded-lg overflow-hidden max-h-64 overflow-y-auto transition-all duration-300 opacity-0 pointer-events-none">
                    </div>
                </form>
                <form action="index.html" method="GET">
                    <select name="category"
                        class="p-3 bg-gray-800 border border-gray-700 rounded-lg text-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500 transition">
                        <option value="">All Categories</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </form>
            </div>
        </div>
        <script>
            $('#searchInput').on('keyup', function() {
                let query = $(this).val();
                $.ajax({
                    method: "GET",
                    url: "{{ route('post.search') }}",
                    data: {
                        search: query
                    },
                    success: function(response) {
                        $('#searchResults').html(response).removeClass('opacity-0 pointer-events-none');
                    }
                });
            });
        </script>
