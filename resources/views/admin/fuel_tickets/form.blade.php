@extends('admin.page', ['title' => "Импорт топливных талонов"])

@section('content')
	<h4 class="center">Импорт топливных талонов</h4>
	<div class="row">
		<div class="col l6 offset-l3 m8 offset-m2">
			<div class="row">
				<form action="{{ route('api.fuel_tickets.upload') }}" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="input-field file-field col s12">
                        <div class="btn">
                            <span>Файл</span>
                            {!! Form::file('file') !!}
                        </div>
                        <div class="file-path-wrapper">
                            <input class="file-path validate{{ $errors->has('file') ? ' invalid' : '' }}" type="text" placeholder="Выберите файл">
                        </div>
                    </div>

                    <p>&nbsp;</p>
                    <p>
                        <input class="with-gap" name="show_progress" type="radio" value="0" id="show-progress-0" checked="checked" />
                        <label for="show-progress-0">Не показывать прогресс</label>
                    </p>
                    <p>
                        <input class="with-gap" name="show_progress" type="radio" value="1" id="show-progress-1" />
                        <label for="show-progress-1">Показывать прогресс</label>
                    </p>
                    <p>&nbsp;</p>

                    <div class="input-field col s12 center">
                        <button type="submit" class="btn-large waves-effect waves-light"><i class="material-icons left">check_circle</i> Загрузить файл</button>
                    </div>
				</form>
			</div>
		</div>
	</div>
@endsection
