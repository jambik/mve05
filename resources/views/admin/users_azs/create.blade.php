@extends('admin.page', ['title' => "Пользователи АЗС"])

@section('content')
	<h4 class="center">Создать</h4>
	<div class="row">
		<div class="col l6 offset-l3 m8 offset-m2">
			<div class="row">
				{!! Form::open(['url' => route('admin.users_azs.store'), 'method' => 'POST', 'files' => true]) !!}
					@include('admin.users_azs.form', ['submitButtonText' => 'Добавить'])
				{!! Form::close() !!}
			</div>
		</div>
	</div>
@endsection
