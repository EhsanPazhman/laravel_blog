@include('errors.message')

<div class="bg-gray-800 p-8 rounded-lg shadow-md">
    <h3 class="text-xl font-semibold text-blue-300 mb-4">Manage Comments</h3>

    <table class="w-full border border-gray-700 rounded-lg">
        <thead>
            <tr class="bg-gray-700">
                <th class="p-3 text-left">Comment</th>
                <th class="p-3 text-left">User</th>
                <th class="p-3 text-left">Post</th>
                <th class="p-3 text-left">Status</th>
                <th class="p-3 text-left">Date</th>
                <th class="p-3 text-left">Actions</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($comments as $comment)
                <tr class="hover:bg-gray-700 transition-colors duration-200">

                    {{-- Comment --}}
                    <td class="p-3">{{ $comment->comment }}</td>

                    {{-- User --}}
                    <td class="p-3">{{ $comment->user->name }}</td>

                    {{-- Post --}}
                    <td class="p-3">{{ $comment->post->title }}</td>

                    {{-- STATUS Badge --}}
                    <td class="p-3">
                        @if ($comment->status === 'approved')
                            <span class="px-2 py-1 text-xs rounded bg-green-600 text-white">Approved</span>
                        @elseif ($comment->status === 'rejected')
                            <span class="px-2 py-1 text-xs rounded bg-red-600 text-white">Rejected</span>
                        @else
                            <span class="px-2 py-1 text-xs rounded bg-yellow-500 text-black">Pending</span>
                        @endif
                    </td>

                    {{-- DATE --}}
                    <td class="p-3">{{ $comment->created_at->format('Y-m-d H:i') }}</td>

                    {{-- ACTIONS --}}
                    <td class="p-3 flex gap-3">

                        {{-- APPROVE BUTTON (only if pending/rejected) --}}
                        @if ($comment->status !== 'approved')
                            <form action="{{ route('admin.comments.updateStatus', $comment->id) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <input type="hidden" name="status" value="approved">
                                <button class="px-3 py-1 text-xs rounded bg-green-600 text-white hover:bg-green-500">
                                    Approve
                                </button>
                            </form>
                        @endif

                        {{-- REJECT BUTTON (only if pending/approved) --}}
                        @if ($comment->status !== 'rejected')
                            <form action="{{ route('admin.comments.updateStatus', $comment->id) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <input type="hidden" name="status" value="rejected">
                                <button class="px-3 py-1 text-xs rounded bg-red-600 text-white hover:bg-red-500">
                                    Reject
                                </button>
                            </form>
                        @endif

                        {{-- EDIT --}}
                        <a href="{{ route('admin.comments.edit', $comment->id) }}"
                            class="px-3 py-1 text-xs rounded bg-blue-600 text-white hover:bg-blue-500">
                            Edit
                        </a>

                        {{-- DELETE --}}
                        <form action="{{ route('admin.comments.destroy', $comment->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="px-3 py-1 text-xs rounded bg-gray-600 text-white hover:bg-gray-500">
                                Delete
                            </button>
                        </form>

                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
