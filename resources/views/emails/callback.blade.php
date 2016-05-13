@extends('beautymail::templates.sunny')

@section('content')

    @include ('beautymail::templates.sunny.heading' , [
        'heading' => 'Обратный звонок',
        'level' => 'h1',
    ])

    @include('beautymail::templates.sunny.contentStart')

    <p>Поступила заявка на обратный звонок</p>
    <hr />
    <p><strong>Данные от пользователя:</strong></p>
    <p>Имя: {{ $input['name'] }}</p>
    <p>Телефон: {{ $input['phone'] }}</p>

    @include('beautymail::templates.sunny.contentEnd')

@endsection