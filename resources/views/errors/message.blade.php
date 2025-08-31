@if (session('success'))
    <div class="text-green-700 text-lg font-bold">
        {{ session('success') }}
    </div>
@endif
@if (session('failed'))
    <div class="text-red-900 text-lg font-bold">
        {{ session('failed') }}
    </div>
@endif
@if ($errors->any())
    <div class="text-red-700 text-lg font-bold">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
