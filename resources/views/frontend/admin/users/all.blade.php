           @include('errors.message')
           <div class="bg-gray-800 p-8 rounded-lg shadow-md">
               <h3 class="text-xl font-semibold text-blue-300 mb-4">Manage Users</h3>
               <table class="w-full border border-gray-700 rounded-lg">
                   <thead>
                       <tr class="bg-gray-700">
                           <th class="p-3 text-left">Name</th>
                           <th class="p-3 text-left">Email</th>
                           <th class="p-3 text-left">Role</th>
                           <th class="p-3 text-left">Jonied</th>
                           <th class="p-3 text-left">Actions</th>
                       </tr>
                   </thead>
                   <tbody>
                       @foreach ($AllUsers as $user)
                           <tr class="hover:bg-gray-700 transition-colors duration-200">
                               <td class="p-3">{{ $user->name }}</td>
                               <td class="p-3">{{ $user->email }}</td>
                               <td class="p-3">{{ $user->role }}</td>
                               <td class="p-3">{{ $user->created_at->format('Y-m-d H:i') }}</td>
                               <td class="p-3">
                                   <a href="{{ route('admin.users.edit', $user->id) }}"
                                       class="text-blue-400 hover:text-blue-300 transition-colors duration-200">Edit</a>
                                   <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST"
                                       class="inline ml-2"
                                       onsubmit="return confirm('Are you sure you want to delete this user?');">
                                       @csrf
                                       @method('DELETE')
                                       <button
                                           class="text-red-400 hover:text-red-300 transition-colors duration-200">Delete</button>
                                   </form>
                               </td>
                           </tr>
                       @endforeach
                   </tbody>
               </table>
               <div class="mt-4">
                   {{ $AllUsers->links() }}
               </div>
           </div>
