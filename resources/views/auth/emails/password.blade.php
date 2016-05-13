@extends('beautymail::templates.sunny')

@section('content')

    @include ('beautymail::templates.sunny.heading' , [
        'heading' => 'Смена пароля',
        'level' => 'h1',
    ])

    @include('beautymail::templates.sunny.contentStart')

    <p>Вы сделали запрос на сброс пароля. Нажмите ссылку ниже в течении ближайшего часа, чтобы сменить пароль.</p>

    @include('beautymail::templates.sunny.contentEnd')

    @include('beautymail::templates.sunny.button', [
        'title' => 'Сбросить пароль',
        'link' => url('password/reset', $token).'?email='.urlencode($user->getEmailForPasswordReset()),
    ])

@endsection
