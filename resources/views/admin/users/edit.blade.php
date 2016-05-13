@extends('admin.page', ['title' => "Пользователи"])

@section('content')
	<h4 class="center">Редактировать</h4>
	<div class="row">
		<div class="col l6 offset-l3 m8 offset-m2">
			<div class="row">
				{!! Form::model($item, ['url' => route('admin.users.update', $item->id), 'method' => 'PUT', 'files' => true]) !!}
					@include('admin.users.form', ['submitButtonText' => 'Обновить'])
				{!! Form::close() !!}
			</div>
		</div>
	</div>
@endsection
