<div class="input-field col s12">
    {!! Form::label('code', 'Штрихкод') !!}
    {!! Form::text('code', null, ['class' => 'validate'.($errors->has('code') ? ' invalid' : '')]) !!}
</div>

<div class="input-field col s12">
    {!! Form::label('type', 'Вид талона') !!}
    {!! Form::text('type', null, ['class' => 'validate'.($errors->has('type') ? ' invalid' : '')]) !!}
</div>

<div class="input-field col s12">
    {!! Form::label('serial', 'Порядковый номер внутри вида талона') !!}
    {!! Form::text('serial', null, ['class' => 'validate'.($errors->has('serial') ? ' invalid' : '')]) !!}
</div>

<div class="input-field col s12">
    {!! Form::label('fuel', 'Марка топлива') !!}
    {!! Form::text('fuel', null, ['class' => 'validate'.($errors->has('fuel') ? ' invalid' : '')]) !!}
</div>

<div class="input-field col s12">
    {!! Form::label('liters', 'Номинал в литрах') !!}
    {!! Form::text('liters', null, ['class' => 'validate'.($errors->has('liters') ? ' invalid' : '')]) !!}
</div>

<div class="input-field col s12">
    {!! Form::label('ticket_sold_type', 'Вид продажи талона') !!}
    {!! Form::text('ticket_sold_type', null, ['class' => 'validate'.($errors->has('ticket_sold_type') ? ' invalid' : '')]) !!}
</div>

<div class="input-field col s12 input-checkbox">
    {!! Form::checkbox('is_exchange', 1, null, ['id' => 'is_exchange', 'class' => $errors->has('is_exchange') ? ' invalid' : '']) !!}
    {!! Form::label('is_exchange', 'Продан по обмену') !!}
</div>

<div class="input-field col s12 input-datetime">
    {!! Form::label('sold_at', 'Дата продажи') !!}
    {!! Form::text('sold_at', null, ['class' => 'validate'.($errors->has('sold_at') ? ' invalid' : '')]) !!}
</div>

<div class="input-field col s12">
    {!! Form::label('sold_document', 'Документ продажи') !!}
    {!! Form::text('sold_document', null, ['class' => 'validate'.($errors->has('sold_document') ? ' invalid' : '')]) !!}
</div>

<div class="input-field col s12">
    {!! Form::label('contractor', 'Контрагент') !!}
    {!! Form::text('contractor', null, ['class' => 'validate'.($errors->has('contractor') ? ' invalid' : '')]) !!}
</div>

<div class="input-field col s12 input-datetime">
    {!! Form::label('expired_at', 'Действителен до') !!}
    {!! Form::text('expired_at', null, ['class' => 'validate'.($errors->has('expired_at') ? ' invalid' : '')]) !!}
</div>

<div class="input-field col s12">
    {!! Form::label('purchase_price', 'Закупочная цена на день продажи') !!}
    {!! Form::text('purchase_price', null, ['class' => 'validate'.($errors->has('purchase_price') ? ' invalid' : '')]) !!}
</div>

<div class="input-field col s12">
    {!! Form::label('retail_price', 'Розничная цена на день продажи') !!}
    {!! Form::text('retail_price', null, ['class' => 'validate'.($errors->has('retail_price') ? ' invalid' : '')]) !!}
</div>

<div class="input-field col s12">
    {!! Form::label('sold_price', 'Цена по которой продано топливо') !!}
    {!! Form::text('sold_price', null, ['class' => 'validate'.($errors->has('sold_price') ? ' invalid' : '')]) !!}
</div>

<div class="input-field col s12">
    {!! Form::label('ticket_sold_price', 'Цена по которой продан талон') !!}
    {!! Form::text('ticket_sold_price', null, ['class' => 'validate'.($errors->has('ticket_sold_price') ? ' invalid' : '')]) !!}
</div>

<div class="input-field col s12 input-checkbox">
    {!! Form::checkbox('is_returned', 1, null, ['id' => 'is_returned', 'class' => $errors->has('is_returned') ? ' invalid' : '']) !!}
    {!! Form::label('is_returned', 'Талон вернулся') !!}
</div>

<div class="input-field col s12 input-checkbox">
    {!! Form::checkbox('is_returned_exchange', 1, null, ['id' => 'is_returned_exchange', 'class' => $errors->has('is_returned_exchange') ? ' invalid' : '']) !!}
    {!! Form::label('is_returned_exchange', 'Возвращен по обмену') !!}
</div>

<div class="input-field col s12">
    {!! Form::label('returned_type', 'Вид возврата талона') !!}
    {!! Form::text('returned_type', null, ['class' => 'validate'.($errors->has('returned_type') ? ' invalid' : '')]) !!}
</div>

<div class="input-field col s12">
    {!! Form::label('gas_station', 'АЗС') !!}
    {!! Form::text('gas_station', null, ['class' => 'validate'.($errors->has('gas_station') ? ' invalid' : '')]) !!}
</div>

<div class="input-field col s12 input-datetime">
    {!! Form::label('returned_at', 'Дата возврата') !!}
    {!! Form::text('returned_at', null, ['class' => 'validate'.($errors->has('returned_at') ? ' invalid' : '')]) !!}
</div>

<div class="input-field col s12">
    {!! Form::label('returned_document', 'Документ возврата') !!}
    {!! Form::text('returned_document', null, ['class' => 'validate'.($errors->has('returned_document') ? ' invalid' : '')]) !!}
</div>

<div class="input-field col s12">
    {!! Form::label('returned_purchase_price', 'Закупочная цена на день возврата') !!}
    {!! Form::text('returned_purchase_price', null, ['class' => 'validate'.($errors->has('returned_purchase_price') ? ' invalid' : '')]) !!}
</div>

<div class="input-field col s12">
    {!! Form::label('returned_retail_price', 'Розничная цена на день возврата') !!}
    {!! Form::text('returned_retail_price', null, ['class' => 'validate'.($errors->has('returned_retail_price') ? ' invalid' : '')]) !!}
</div>

<div class="input-field col s12">
    {!! Form::label('returned_total_price', 'Цена по которой талон куплен у клиента') !!}
    {!! Form::text('returned_total_price', null, ['class' => 'validate'.($errors->has('returned_total_price') ? ' invalid' : '')]) !!}
</div>

<div class="input-field col s12">
    {!! Form::label('quantity', 'Количество') !!}
    {!! Form::text('quantity', null, ['class' => 'validate'.($errors->has('quantity') ? ' invalid' : '')]) !!}
</div>

<div class="input-field col s12 center">
    <button type="submit" class="btn-large waves-effect waves-light"><i class="material-icons left">check_circle</i> {{ $submitButtonText }}</button>
</div>

<div class="input-field col s12 center">
    <a href="{{ route('admin.fuel_tickets.index') }}" class="btn grey waves-effect waves-light">Отмена</a>
</div>