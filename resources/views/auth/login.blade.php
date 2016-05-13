@extends('layouts.auth')

@section('title', 'Логин')

@section('content')
    <p>&nbsp;</p>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div><a href="{{ route('index') }}"><i class="fa fa-arrow-left"></i> на главную</a></div>
                        <p class="text-center">
                            <img src="/img/logo.png">
                        </p>
                        <div>&nbsp;</div>
                        @include('partials._status')
                        @include('partials._errors')
                        <form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
                            {!! csrf_field() !!}

                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label">E-Mail</label>

                                <div class="col-md-6">
                                    <input type="email" class="form-control" name="email" value="{{ old('email') }}">

                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label">Пароль</label>

                                <div class="col-md-6">
                                    <input type="password" class="form-control" name="password">

                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="remember"> Запомнить меня
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fa fa-btn fa-sign-in"></i> Логин
                                    </button>

                                    <a class="btn btn-link" href="{{ url('/password/reset') }}">Забыли пароль?</a>
                                </div>
                            </div>
                        </form>
                        <hr>
                        <h4 class="text-center">
                            Вход через социальные сети:
                        </h4>
                        <div>&nbsp;</div>
                        <div>
                            <div class="row">
                                <div class="col-sm-3 col-sm-offset-2" style="margin-bottom: 30px;">
                                    <a href="{{ url('/auth/google') }}"><img src="/img/social-button-google.png" style="width: 40px; height: 40px; margin-right: 10px;">Google+</a>
                                </div>
                                <div class="col-sm-3" style="margin-bottom: 30px;">
                                    <a href="{{ url('/auth/facebook') }}"><img src="/img/social-button-facebook.png" style="width: 40px; height: 40px; margin-right: 10px;">Facebook</a>
                                </div>
                                <div class="col-sm-3" style="margin-bottom: 30px;">
                                    <a href="{{ url('/auth/twitter') }}"><img src="/img/social-button-twitter.png" style="width: 40px; height: 40px; margin-right: 10px;">Twitter</a>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-3 col-sm-offset-2" style="margin-bottom: 30px;">
                                    <a href="{{ url('/auth/vkontakte') }}"><img src="/img/social-button-vkontakte.png" style="width: 40px; height: 40px; margin-right: 10px;">ВКонтакте</a>
                                </div>
                                <div class="col-sm-3" style="margin-bottom: 30px;">
                                    <a href="{{ url('/auth/yandex') }}"><img src="/img/social-button-yandex.png" style="width: 40px; height: 40px; margin-right: 10px;">Яндекс</a>
                                </div>
                                <div class="col-sm-3" style="margin-bottom: 30px;">
                                    <a href="{{ url('/auth/mailru') }}"><img src="/img/social-button-mail.ru.png" style="width: 40px; height: 40px; margin-right: 10px;">Mail.ru</a>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-4 col-sm-offset-2" style="margin-bottom: 30px;">
                                    <a href="{{ url('/auth/odnoklassniki') }}"><img src="/img/social-button-odnoklassniki.png" style="width: 40px; height: 40px; margin-right: 10px;">Одноклассники</a>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div>&nbsp;</div>
                        <p class="text-center">
                            <a href="{{ url('/register') }}"><i class="fa fa-btn fa-user"></i> Регистрация на сайте</a>
                        </p>
                        <div>&nbsp;</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
