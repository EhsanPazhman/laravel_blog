  @extends('frontend.layouts.master')
  @section('title', 'Edit Comment')
  @section('content')
      <div class="flex-grow container mx-auto my-8 px-4 flex flex-wrap -mx-3">
          <div class="container mx-auto my-8 px-4">
              <a href="{{ route('admin.dashboard') }}"
                  class="bg-red-600 hover:bg-green-500 text-white p-3 rounded-lg transition-colors duration-200">Return to
                  home
                  page</a>
              <div class="bg-gray-800 p-8 rounded-lg shadow-md max-w-md mx-auto">
                  @include('errors.message')
                  <!-- Comments -->
                  <div class="container mx-auto px-4">
                      <!-- Comment Form -->
                      <form action="{{ route('admin.comments.update', $comment->id) }}" method="POST"
                          class="bg-gray-800 p-6 rounded-lg shadow-md">
                          @csrf
                          @method('PUT')
                          <textarea name="comment"
                              class="w-full p-3 bg-gray-700 border border-gray-600 rounded-lg text-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500 transition">{{ $comment['comment'] }}</textarea>
                          <button type="submit"
                              class="bg-blue-600 hover:bg-blue-500 text-white p-3 rounded-lg mt-4 transition-colors duration-200">Update
                              Comment</button>
                      </form>
                  </div>
              </div>
          </div>
      </div>
  @endsection
