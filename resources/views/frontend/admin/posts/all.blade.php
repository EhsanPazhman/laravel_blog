       <div class="bg-gray-800 p-8 rounded-lg shadow-md mb-8">
           <h3 class="text-xl font-semibold text-blue-300 mb-4">Manage Posts</h3>
           <a href="/admin/posts/add"
               class="bg-blue-600 hover:bg-blue-500 text-white p-3 rounded-lg mb-4 inline-block transition-colors duration-200">Add
               New Post</a>
           <table class="w-full border border-gray-700 rounded-lg">
               <thead>
                   <tr class="bg-gray-700">
                       <th class="p-3 text-left">Title</th>
                       <th class="p-3 text-left">Content</th>
                       <th class="p-3 text-left">Image</th>
                       <th class="p-3 text-left">Author</th>
                       <th class="p-3 text-left">Category</th>
                       <th class="p-3 text-left">Date</th>
                       <th class="p-3 text-left">Actions</th>
                   </tr>
               </thead>
               <tbody>
                   @foreach ($posts as $post)
                       <tr class="hover:bg-gray-700 transition-colors duration-200">
                           <td class="p-3">{{ $post->title }}</td>
                           <td class="p-3">{{ substr($post->content, 0,10) }}</td>
                           <td class="p-3"><img src="/{{ $post->image }}" alt="" style="width: 100px; height:80px"></td>
                           <td class="p-3">{{ $post->user->name }}</td>
                           <td class="p-3">{{ $post->category->name }}</td>
                           <td class="p-3">{{ $post->created_at }}</td>
                           <td class="p-3">
                               <a href="/admin/posts/edit"
                                   class="text-blue-400 hover:text-blue-300 transition-colors duration-200">Edit</a>
                               <a href="/admin/posts/delete"
                                   class="text-red-400 hover:text-red-300 transition-colors duration-200 ml-2">Delete</a>
                           </td>
                       </tr>
                   @endforeach
               </tbody>
           </table>
       </div>
