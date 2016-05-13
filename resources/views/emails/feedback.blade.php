@extends('beautymail::templates.sunny')

@section('content')

    @include ('beautymail::templates.sunny.heading' , [
        'heading' => 'Обратная связь',
        'level' => 'h1',
    ])

    @include('beautymail::templates.sunny.contentStart')

    <hr />
    <p><strong>Данные от пользователя:</strong></p>
    <p>Имя: {{ $input['name'] }}</p>
    <p>Телефон: {{ $input['phone'] }}</p>
    <p>Email: {{ $input['email'] }}</p>
    <p>Сообщение: {{ $input['message'] }}</p>

    @include('beautymail::templates.sunny.contentEnd')

@endsection