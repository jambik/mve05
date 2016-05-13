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
            <a class="navbar-brand" href="{{ route('index') }}"><img alt="Brand" src="{{ asset('img/logo.png') }}" style="width: 30px; display: inline-block; vertical-align: middle;" class="img-responsive"> Laravel CMS</a>
        </div>
        <div class="collapse navbar-collapse" id="navbar">
            <ul class="nav navbar-nav">
                <li><a href="{{ route('page.show', 'o-kompanii') }}">О компании</a></li>
                <li><a href="{{ route('page.show', 'kontakty') }}">Контакты</a></li>
                <li><a href="{{ route('catalog') }}">Каталог</a></li>
                <li><a href="{{ route('articles') }}">Статьи</a></li>
                <li><a href="{{ route('news') }}">Новости</a></li>
                <li><a href="{{ route('galleries') }}">Фотогалерея</a></li>
                <li><a href="{{ route('feedback') }}">Обратная связь</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                @if (Auth::check())
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" id="dropdownUser" data-toggle="dropdown" aria-expanded="true">
                            <img class="avatar img-circle img-thumbnail" src="{{ Auth::user()->avatar ?: asset('img/avatar.png') }}">
                            <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownUser">
                            <li role="presentation"><a role="menuitem" tabindex="-1" href="{{ route('profile.personal') }}"><i class="fa fa-user"></i> Личный кабинет</a></li>
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

<header>
    <div class="container">
        <div class="row">
            @include('partials._status')
            @include('partials._errors')
        </div>
        <div class="row">
            <div class="col-sm-4">
                <div>Телефон: {{ $settings->phone }}</div>
                <div>Email: {{ $settings->email }}</div>
            </div>
            <div class="col-sm-4 text-center">
                <div class="lead">
                    <a href="#" data-toggle="modal" data-target="#callbackModal"><i class="fa fa-volume-control-phone" aria-hidden="true"></i> Обратный звонок</a>
                </div>
            </div>
            <div class="col-sm-4 text-right">
                <form action="{{ route('search') }}" method="GET" class="inline-form">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control input-sm" placeholder="Поиск по сайту">
                        <span class="input-group-btn">
                            <button class="btn btn-default btn-sm" type="button">Go!</button>
                        </span>
                    </div>
                </form>
            </div>
        </div>
    </div>
</header>

@yield('slides')

<section id="blocks">
    <div class="container">
        <div class="row">
            <div class="col-lg-4">
                <div class="jumbotron text-center lead">
                    Блок 1
                </div>
            </div>
            <div class="col-lg-4">
                <div class="jumbotron text-center lead">
                    Блок 2
                </div>
            </div>
            <div class="col-lg-4">
                <div class="jumbotron text-center lead">
                    Блок 3
                </div>
            </div>
        </div>
    </div>
</section>

<section id="main">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-4">
                <p class="lead">Каталог</p>
                @include('partials._categories')
            </div>
            <div class="col-lg-9 col-md-8">
                @yield('content')
            </div>
        </div>
    </div>
</section>

<footer>
    <div class="container">
        <div class="row">
            <div class="copyright">копирайт</div>
        </div>
        <div class="row">
            <ul>
                <li><a href="{{ route('index') }}">Главная</a></li>
                <li><a href="{{ route('page.show', 'o-kompanii') }}">О компании</a></li>
                <li><a href="{{ route('page.show', 'kontakty') }}">Контакты</a></li>
                <li><a href="{{ route('catalog') }}">Каталог</a></li>
                <li><a href="{{ route('articles') }}">Статьи</a></li>
                <li><a href="{{ route('news') }}">Новости</a></li>
                <li><a href="{{ route('galleries') }}">Фотогалерея</a></li>
                <li><a href="{{ route('feedback') }}">Обратная связь</a></li>
            </ul>
        </div>
    </div>
</footer>

@include('partials._callback')
@include('partials._flash')
@include('partials._metrika')

@yield('footer_scripts')

</body>
</html>