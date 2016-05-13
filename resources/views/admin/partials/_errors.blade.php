@if (count($errors) > 0)
    <div class="card-panel red darken-4 white-text">
        <strong>Ошибка</strong>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif