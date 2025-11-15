            @include('errors.message')
            <div class="bg-gray-800 p-8 rounded-lg shadow-md">
                <h3 class="text-xl font-semibold text-blue-300 mb-4">Manage Categories</h3>
                <a href="{{ route('admin.categories.create') }}"
                    class="bg-blue-600 hover:bg-blue-500 text-white p-3 rounded-lg mb-4 inline-block transition-colors duration-200">Add
                    New Category</a>
                <table class="w-full border border-gray-700 rounded-lg">
                    <thead>
                        <tr class="bg-gray-700">
                            <th class="p-3 text-left">Name</th>
                            <th class="p-3 text-left">Slug</th>
                            <th class="p-3 text-left">Date</th>
                            <th class="p-3 text-left">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($AllCategories as $category)
                            <tr class="hover:bg-gray-700 transition-colors duration-200">
                                <td class="p-3">{{ $category->name }}</td>
                                <td class="p-3">{{ $category->slug }}</td>
                                <td class="p-3">{{ $category->created_at }}</td>
                                <td class="p-3">
                                    <a href="{{ route('admin.categories.edit', $category->id) }}"
                                        class="text-blue-400 hover:text-blue-300 transition-colors duration-200">Edit</a>
                                    <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST"
                                        class="text-red-400 hover:text-red-300 transition-colors duration-200 ml-2"
                                        style="display: inline">
                                        @csrf
                                        @method('DELETE')
                                        <button>Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="mt-4">
                    {{ $AllCategories->links() }}
                </div>

            </div>
