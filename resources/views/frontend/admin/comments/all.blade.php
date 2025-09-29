      <div class="bg-gray-800 p-8 rounded-lg shadow-md">
          <h3 class="text-xl font-semibold text-blue-300 mb-4">Manage Comments</h3>
          <table class="w-full border border-gray-700 rounded-lg">
              <thead>
                  <tr class="bg-gray-700">
                      <th class="p-3 text-left">Comment</th>
                      <th class="p-3 text-left">User</th>
                      <th class="p-3 text-left">Post</th>
                      <th class="p-3 text-left">Date</th>
                      <th class="p-3 text-left">Actions</th>
                  </tr>
              </thead>
              <tbody>
                  @foreach ($comments as $comment)
                      <tr class="hover:bg-gray-700 transition-colors duration-200">
                          <td class="p-3">{{ $comment->comment }}</td>
                          <td class="p-3">{{ $comment->user->name }}</td>
                          <td class="p-3">{{ $comment->post->title }}</td>
                          <td class="p-3">{{ $comment->created_at }}</td>
                          <td class="p-3">
                              <a href="{{ route('admin.comments.edit', $comment->id) }}"
                                  class="text-blue-400 hover:text-blue-300 transition-colors duration-200">Edit</a>
                              <form action="{{ route('admin.comments.destroy', $comment->id) }}" method="POST"
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
      </div>
