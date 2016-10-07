<div class="input-field col s12">
    {!! Form::label('title', 'Заголовок новости') !!}
    {!! Form::text('title', null, ['class' => 'validate'.($errors->has('title') ? ' invalid' : '')]) !!}
</div>

<div class="input-field col s12 input-html">
    {!! Form::label('text', 'Текст новости') !!}
    {!! Form::textarea('text', null, ['class' => 'validate materialize-textarea'.($errors->has('text') ? ' invalid' : '')]) !!}
</div>

<div class="input-field col s12 input-datetime">
    {!! Form::label('published_at', 'Дата публикации') !!}
    {!! Form::text('published_at', null, ['class' => 'validate'.($errors->has('published_at') ? ' invalid' : '')]) !!}
</div>

@include('admin.partials._imageable')

<div class="input-field col s12 center">
    <button type="submit" class="btn-large waves-effect waves-light"><i class="material-icons left">check_circle</i> {{ $submitButtonText }}</button>
</div>

<div class="input-field col s12 center">
    <a href="{{ route('admin.news.index') }}" class="btn grey waves-effect waves-light">Отмена</a>
</div>

@section('head_scripts')
    <script src="/library/ckeditor/ckeditor.js"></script>
@endsection