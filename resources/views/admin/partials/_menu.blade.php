<ul class="collection with-header">
    <li class="collection-header"><strong>Топливные талоны</strong></li>
    <a class="collection-item" href="#"><i class="material-icons left">credit_card</i>Талоны</a>
    <a class="collection-item" href="{{ route('admin.fuel_tickets.form') }}"><i class="material-icons left">file_upload</i>Загрузить талоны</a>
    <a class="collection-item" href="#"><i class="material-icons left">history</i>История загрузок</a>
    <a class="collection-item" href="#"><i class="material-icons left">account_box</i>Пользователи (1С)</a>
</ul>

<ul class="collection with-header">
    <li class="collection-header"><strong>АЗС</strong></li>
    <a class="collection-item" href="#"><i class="material-icons left">local_gas_station</i>АЗС</a>
    <a class="collection-item" href="#"><i class="material-icons left">history</i>История запросов</a>
</ul>

<ul class="collection with-header">
    <li class="collection-header"><strong>Общие настройки</strong></li>
    <a class="collection-item" href="{{ route('admin.settings') }}"><i class="material-icons left">settings</i>Настройки</a>
    <a class="collection-item" href="{{ route('admin.administrators.index') }}"><i class="material-icons left">verified_user</i>Администраторы</a>
</ul>