<div class="input-field col s12">
    {!! Form::label('file_name', 'Файл') !!}
    {!! Form::text('file_name', null, ['class' => 'validate'.($errors->has('file_name') ? ' invalid' : '')]) !!}
</div>

<div class="input-field col s12 input-checkbox">
    {!! Form::checkbox('is_imported', 1, null, ['id' => 'is_imported', 'class' => $errors->has('is_imported') ? ' invalid' : '']) !!}
    {!! Form::label('is_imported', 'Импортирован') !!}
</div>

<div class="input-field col s12">
    {!! Form::label('rows_imported', 'Записей импортировано') !!}
    {!! Form::text('rows_imported', null, ['class' => 'validate'.($errors->has('rows_imported') ? ' invalid' : '')]) !!}
</div>

<div class="input-field col s12">
    {!! Form::label('total_rows', 'Всего записей') !!}
    {!! Form::text('total_rows', null, ['class' => 'validate'.($errors->has('total_rows') ? ' invalid' : '')]) !!}
</div>

@if (isset($item))
    <div class="input-field col s12">
        {!! Form::label('user_id', 'Пользователь #') !!}
        {!! Form::text('user_id', null, ['class' => 'validate'.($errors->has('user_id') ? ' invalid' : '')]) !!}
    </div>
@endif

<div class="input-field col s12 center">
    <button type="submit" class="btn-large waves-effect waves-light"><i class="material-icons left">check_circle</i> {{ $submitButtonText }}</button>
</div>

<div class="input-field col s12 center">
    <a href="{{ route('admin.log_access.index') }}" class="btn grey waves-effect waves-light">Отмена</a>
</div>