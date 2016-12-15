<div class="input-field col s12">
    {!! Form::label('name', 'Название АЗС') !!}
    {!! Form::text('name', null, ['class' => 'validate'.($errors->has('name') ? ' invalid' : '')]) !!}
</div>

<div class="input-field col s12">
    {!! Form::label('description', 'Описание') !!}
    {!! Form::textarea('description', null, ['class' => 'validate materialize-textarea'.($errors->has('description') ? ' invalid' : '')]) !!}
</div>

<div class="input-field col s12">
    {!! Form::label('location', 'Место расположения') !!}
    {!! Form::text('location', null, ['class' => 'validate'.($errors->has('location') ? ' invalid' : '')]) !!}
</div>

<div class="input-field col s12">
    {!! Form::label('address', 'Адрес') !!}
    {!! Form::text('address', null, ['class' => 'validate'.($errors->has('address') ? ' invalid' : '')]) !!}
</div>

<div class="input-field col s12">
    {!! Form::label('lat', 'Широта') !!}
    {!! Form::text('lat', null, ['class' => 'validate'.($errors->has('lat') ? ' invalid' : '')]) !!}
</div>

<div class="input-field col s12">
    {!! Form::label('lng', 'Долгота') !!}
    {!! Form::text('lng', null, ['class' => 'validate'.($errors->has('lng') ? ' invalid' : '')]) !!}
</div>

<div class="input-field col s12 center">
    <button type="submit" class="btn-large waves-effect waves-light"><i class="material-icons left">check_circle</i> {{ $submitButtonText }}</button>
</div>

<div class="input-field col s12 center">
    <a href="{{ route('admin.azs.index') }}" class="btn grey waves-effect waves-light">Отмена</a>
</div>