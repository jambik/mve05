<header class="container-fluid">
    <div class="row">
        <nav class="teal darken-3">
            <div class="nav-wrapper">
                <div class="col s12">
                    <a href="{{ url('/admin') }}" class="brand-logo"><img src="/img/logo.png" class="img-responsive" style="height: 35px;"> Мебель комфорта</a>
                    <ul id="nav-mobile" class="right hide-on-med-and-down">
                        <li><a class="dropdown-button" href="#" data-activates="user-dropdown"><i class="material-icons left">account_circle</i> {{ Auth::user()->name }}</a></li>
                        <li><a class="dropdown-button" href="#" data-activates="settings-dropdown"><i class="material-icons left">settings</i> Настройки</a></li>
                    </ul>
                    <ul id="user-dropdown" class="dropdown-content">
                        <li><a href="{{ route('admin.logout') }}"><i class="material-icons left">exit_to_app</i> Выход</a></li>
                    </ul>
                    <ul id="settings-dropdown" class="dropdown-content" style="min-width: 250px;">
                        <li><a href="/" target="_blank"><i class="material-icons left">open_in_new</i> Открыть сайт</a></li>
                        <li><a href="{{ route('admin.settings') }}"><i class="material-icons left">settings</i> Настройки сайта</a></li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
</header>