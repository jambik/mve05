<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}"/>

    <!-- Styles -->
    <link href="{{ asset('/css/app.bundle.css') }}" type="text/css" rel="stylesheet">
    <link href="{{ asset('/css/app.css') }}" type="text/css" rel="stylesheet">
    {{-- <link href="{{ elixir('css/app.css') }}" rel="stylesheet"> --}}

    <!-- Scripts -->
    <script src="{{ asset('/js/app.bundle.js') }}" type="text/javascript"></script>
    <script src="{{ asset('/js/app.js') }}" type="text/javascript"></script>
    {{-- <script src="{{ elixir('js/app.js') }}"></script> --}}

    @yield('header_scripts')

    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <title>@yield('title')</title>
</head>
<body>

@yield('content')

@include('partials._flash')
@include('partials._metrika')

@yield('footer_scripts')

</body>
</html>