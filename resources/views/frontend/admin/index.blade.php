@extends('frontend.admin.layouts.master')
@section('title', 'Admin Dashboard')
@section('content')
    <div class="container mx-auto my-8 px-4">
        @if ($page === 'dashboard')
            @include('frontend.admin.layouts.dashboard')
        @elseif($page === 'posts')
            @include('frontend.admin.posts.all')
        @elseif($page === 'categories')
            @include('frontend.admin.categories.all')
        @elseif($page === 'comments')
            @include('frontend.admin.comments.all')
        @elseif($page === 'users')
            @include('frontend.admin.users.all')
        @else
            <p>Page Not Found!</p>
        @endif
    </div>
@endsection