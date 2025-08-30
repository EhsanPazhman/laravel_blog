@extends('frontend.admin.layouts.master')
@section('title', 'Admin Panel')
@section('content')
        <!-- Admin Panel -->
    <div class="container mx-auto my-8 px-4">
        <h2 class="text-2xl font-semibold text-blue-300 mb-6">Admin Panel</h2>
        <!-- Manage Posts -->
        @include('frontend.admin.posts.all')
        <!-- Manage Categories -->
        @include('frontend.admin.categories.all')
    </div>
@endsection
