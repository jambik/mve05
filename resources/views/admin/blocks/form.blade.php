<div class="input-field col s12">
    {!! Form::label('alias', 'Alias') !!}
    {!! Form::text('alias', null, ['class' => 'validate'.($errors->has('alias') ? ' invalid' : '')]) !!}
</div>

<div class="input-field col s12">
    {!! Form::label('title', 'Название') !!}
    {!! Form::text('title', null, ['class' => 'validate'.($errors->has('title') ? ' invalid' : '')]) !!}
</div>

<div class="input-field col s12 input-html">
    {!! Form::label('text', 'Текст') !!}
    {!! Form::textarea('text', null, ['class' => 'materialize-textarea validate'.($errors->has('text') ? ' invalid' : '')]) !!}
</div>

<div class="input-field col s12 center">
    <button type="submit" class="btn-large waves-effect waves-light"><i class="material-icons left">check_circle</i> {{ $submitButtonText }}</button>
</div>

<div class="input-field col s12 center">
    <a href="{{ route('admin.blocks.index') }}" class="btn grey waves-effect waves-light">Отмена</a>
</div>

@section('head_scripts')
    <script src="/library/ckeditor/ckeditor.js"></script>
@endsection