@include('frontend.admin.layouts.header')

<div class="flex flex-1">
    @include('frontend.admin.layouts.sidebar')
    <main id="main-content" class="flex-1 transition-all duration-300 ease-in-out p-6 md:ml-64">
        @yield('content')
    </main>
</div>

@include('frontend.admin.layouts.footer')