<div class="input-field col s12">
    {!! Form::label('name', 'Название') !!}
    {!! Form::text('name', null, ['class' => 'validate'.($errors->has('name') ? ' invalid' : '')]) !!}
</div>

@if (isset($item))
    <div class="input-field col s12">
        {!! Form::label('slug', 'Alias') !!}
        {!! Form::text('slug', null, ['class' => 'validate'.($errors->has('slug') ? ' invalid' : '')]) !!}
        <small>alias для красивого отображения url</small>
    </div>
@endif

<div class="input-field col s12 input-html">
    {!! Form::label('text', 'Текст страницы') !!}
    {!! Form::textarea('text', null, ['class' => 'materialize-textarea validate'.($errors->has('text') ? ' invalid' : '')]) !!}
</div>

@include('admin.partials._headerable')

<div class="input-field col s12 center">
    <button type="submit" class="btn-large waves-effect waves-light"><i class="material-icons left">check_circle</i> {{ $submitButtonText }}</button>
</div>

<div class="input-field col s12 center">
	<a href="{{ route('admin.pages.index') }}" class="btn grey waves-effect waves-light">Отмена</a>
</div>

@section('head_scripts')
    <script src="/library/ckeditor/ckeditor.js"></script>
@endsection