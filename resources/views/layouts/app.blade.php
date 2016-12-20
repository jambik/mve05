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

<nav class="navbar navbar-default">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false">
                <span class="sr-only">Меню</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{ route('index') }}" style="height: auto;">
                <img alt="Brand" src="{{ asset('img/logo.png') }}" style="width: 84px; display: inline-block; vertical-align: middle;" class="img-responsive">
                <span class="brand-name">Топливные талоны</span>
                <span class="brand-slogan">motus vita est</span>
            </a>
        </div>

        <p class="navbar-text">
            <i class="fa fa-phone-square"></i> +7 (8722) 55-54-63<br>
            <i class="fa fa-phone-square"></i> +7 989 665-20-75
        </p>

        <div class="collapse navbar-collapse" id="navbar">
            <ul class="nav navbar-nav navbar-right navbar-personal">
                @if (Auth::check())
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" id="dropdownUser" data-toggle="dropdown" aria-expanded="true">
                            <img class="avatar img-circle img-thumbnail" src="{{ Auth::user()->avatar ?: asset('img/avatar.png') }}">
                            <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownUser">
                            <li role="presentation"><a role="menuitem" tabindex="-1" href="#{{ Auth::user()->name }}"><i class="fa fa-user"></i> Личный кабинет</a></li>
                            <li class="divider"></li>
                            <li role="presentation"><a role="menuitem" tabindex="-1" href="{{ url('logout') }}"><i class="fa fa-sign-out"></i> Выход</a></li>
                        </ul>
                    </li>
                @else
                    <li><a href="{{ url('login') }}"><i class="fa fa-sign-in"></i> Вход</a></li>
                    <li><a href="{{ url('register') }}"><i class="fa fa-user"></i> Регистрация</a></li>
                @endif
            </ul>
        </div>
    </div>
</nav>

<section id="main">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-4">
                <div class="list-group hidden-print">
                    <a href="/" class="list-group-item">Главная</a>
                    <a href="{{ route('page.show', 'about') }}" class="list-group-item">О компании</a>
                    <a href="{{ route('azs') }}" class="list-group-item">Список АЗС</a>
                    <a href="{{ route('news') }}" class="list-group-item">Новости</a>
                    <a href="{{ route('page.show', 'contacts') }}" class="list-group-item">Контакты</a>
                    <a href="{{ route('feedback') }}" class="list-group-item">Обратная связь</a>
                </div>
            </div>
            <div class="col-lg-9 col-md-8">
                @yield('content')
            </div>
        </div>
    </div>
</section>

<section id="footer">
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
</section>

@include('partials._flash')

@yield('footer_scripts')

</body>
</html>