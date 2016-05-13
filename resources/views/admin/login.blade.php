@include('admin.partials._header', ['title' => "Администрирование - Вход"])

<p>&nbsp;</p>
<main class="container">
	<div class="row">
		<div class="col s12 m8 l6 offset-m2 offset-l3">
            <div class="row card-panel">
                <div class="center">
                    <img src="/img/logo.png">
                </div>
                <h4 class="center">Администрирование</h4>
                @include('admin.partials._status')
                @include('admin.partials._errors')
                <form class="col s12" method="POST" action="{{ route('admin.login') }}">
                    {!! csrf_field() !!}

                    <div class="input-field col s12">
                        <input id="email" name="email" type="email" value="{{ old('email') }}" class="validate">
                        <label for="email">Email</label>
                    </div>

                    <div class="input-field col s12">
                        <input id="password" name="password" type="password" class="validate">
                        <label for="password">Пароль</label>
                    </div>

                    <p class="col s12">
                        <input type="checkbox" id="remember" name="remember" />
                        <label for="remember">Запомнить меня</label>
                    </p>

                    <p class="col s12 center">
                        <button type="submit" class="btn-large waves-effect waves-light">Вход</button>
                    </p>
                </form>
            </div>
		</div>
	</div>
</main>

@include('admin.partials._flash')
@include('admin.partials._footer')