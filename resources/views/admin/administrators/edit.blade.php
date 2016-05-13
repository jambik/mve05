@extends('admin.page', ['title' => "Администраторы"])

@section('content')
	<h4 class="center">Редактировать</h4>
	<div class="row">
		<div class="col l6 offset-l3 m8 offset-m2">
			<div class="row">
				{!! Form::model($item, ['url' => route('admin.administrators.update', $item->id), 'method' => 'PUT', 'files' => true]) !!}
					@include('admin.administrators.form', ['submitButtonText' => 'Обновить'])
				{!! Form::close() !!}
			</div>
		</div>
	</div>
@endsection
