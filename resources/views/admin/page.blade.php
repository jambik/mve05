@include('admin.partials._header', ['title' => $title])
@include('admin.partials._nav')

<main class="container-fluid">
    <div class="row">
        <div class="col l3 m4 s4">
            @include('admin.partials._menu')
        </div>
        <div class="col l9 m8 s8">
            @include('admin.partials._status')
            @include('admin.partials._errors')
            @yield('content')
            <p>&nbsp;</p>
        </div>
    </div>
</main>

@include('admin.partials._flash')
@include('admin.partials._footer')