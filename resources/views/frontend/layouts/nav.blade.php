        <!-- Search and Filter -->
        <div class="container mx-auto my-8 px-4">
            <div class="flex flex-col md:flex-row justify-between items-center gap-4 mb-8">
                <form action="{{ route('post.search') }}" method="GET" class="relative w-full md:w-1/4">
                    @csrf
                    <input id="searchInput" type="text" name="search" placeholder="Search posts..."
                        class="w-full p-3 bg-gray-800 border border-gray-700 rounded-lg text-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500 transition">
                    <div id="searchResults" style="z-index:9999; position:absolute; width:100%"
                        class="md:w-1/4 p-5 absolute mt-2 bg-gray-900 border border-gray-700 rounded-lg overflow-hidden max-h-64 overflow-y-auto transition-all duration-300 opacity-0 pointer-events-none">
                    </div>
                </form>
                <form id="filterForm">
                    <select name="category" onchange="filterPosts(this.value)"
                        class="p-3 bg-gray-800 border border-gray-700 rounded-lg text-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500 transition cursor-pointer">
                        <option value="">All Categories</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->slug }}"
                                {{ request()->is('post/category/' . $category->slug) ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </form>
            </div>
        </div>
        <script>
            function filterPosts(slug) {
                if (slug) {
                    window.location.href = `/post/category/${slug}`;
                } else {
                    window.location.href = `/`;
                }
            }

            document.addEventListener('DOMContentLoaded', function() {
                const searchInput = document.getElementById('searchInput');
                const searchResults = document.getElementById('searchResults');
                let timeout = null;

                // Listen for typing in the search box
                searchInput.addEventListener('keyup', function() {
                    clearTimeout(timeout);
                    const query = this.value.trim();

                    // If input is too short, hide results
                    if (query.length < 2) {
                        searchResults.style.opacity = '0';
                        searchResults.style.pointerEvents = 'none';
                        searchResults.innerHTML = '';
                        return;
                    }

                    // Delay search to avoid spamming the server
                    timeout = setTimeout(() => {
                        fetch(`{{ route('post.search') }}?search=${encodeURIComponent(query)}`)
                            .then(response => response.text())
                            .then(html => {
                                // Display search results
                                searchResults.innerHTML = html;
                                searchResults.style.opacity = '1';
                                searchResults.style.pointerEvents = 'auto';
                            })
                            .catch(() => {
                                // Handle network or server error
                                searchResults.innerHTML =
                                    "<div class='p-2 text-red-400'>Error loading results</div>";
                                searchResults.style.opacity = '1';
                                searchResults.style.pointerEvents = 'auto';
                            });
                    }, 300); // Delay in ms
                });

                // Hide search results when clicking outside
                document.addEventListener('click', function(e) {
                    if (!searchResults.contains(e.target) && e.target !== searchInput) {
                        searchResults.style.opacity = '0';
                        searchResults.style.pointerEvents = 'none';
                    }
                });
            });
        </script>
