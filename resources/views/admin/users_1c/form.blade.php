<div class="input-field col s12">
    {!! Form::label('name', 'Имя') !!}
    {!! Form::text('name', null, ['class' => 'validate'.($errors->has('name') ? ' invalid' : '')]) !!}
</div>

<div class="input-field col s12">
    {!! Form::label('email', 'Email') !!}
    {!! Form::text('email', null, ['class' => 'validate'.($errors->has('email') ? ' invalid' : '')]) !!}
</div>

<div class="input-field col s12">
    {!! Form::label('password', 'Пароль') !!}
    {!! Form::text('password', null, ['class' => 'validate'.($errors->has('password') ? ' invalid' : '')]) !!}
    @if (isset($item))<small>Если оставить пароль пустым, то он не изменится</small>@endif
</div>

@if (isset($item))
    <div class="input-field col s12">
        {!! Form::label('api_token', 'API Token') !!}
        {!! Form::text('api_token', null, ['disabled' => 'disabled', 'class' => 'validate'.($errors->has('api_token') ? ' invalid' : '')]) !!}
    </div>
@endif

<div class="input-field col s12 center">
    <button type="submit" class="btn-large waves-effect waves-light"><i class="material-icons left">check_circle</i> {{ $submitButtonText }}</button>
</div>

<div class="input-field col s12 center">
    <a href="{{ route('admin.users_1c.index') }}" class="btn grey waves-effect waves-light">Отмена</a>
</div>