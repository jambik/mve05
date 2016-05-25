@extends('admin.page', ['title' => "Топливные талоны"])

@section('content')
    <h4 class="center">Топливные талоны</h4>
    <p><a href="{{ route('admin.fuel_tickets.create') }}" class="btn waves-effect waves-light"><i class="material-icons left">add_circle</i> Добавить</a></p>

    @if ($items->count())
        <table id="table_items">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Штрихкод</th>
                    <th>Вид талона</th>
                    <th>Номинал в литрах</th>
                    <th>Цена по которой продан талон</th>
                    <th>Контрагент</th>
                    <th>Талон вернулся</th>
                    <th>АЗС</th>
                    <th>Дата возврата</th>
                    <th class="filter-false btn-collumn" data-sorter="false"></th>
                    <th class="filter-false btn-collumn" data-sorter="false"></th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th colspan="11" class="pager form-inline">
                        <button type="button" class="btn btn-small waves-effect waves-light first"><i class="material-icons">first_page</i></button>
                        <button type="button" class="btn btn-small waves-effect waves-light prev"><i class="material-icons">navigate_before</i></button>
                        <span class="pagedisplay"></span> <!-- this can be any element, including an input -->
                        <button type="button" class="btn btn-small waves-effect waves-light next"><i class="material-icons">navigate_next</i></button>
                        <button type="button" class="btn btn-small waves-effect waves-light last"><i class="material-icons">last_page</i></button>
                        <select class="pagesize" title="Размер страницы">
                            <option selected="selected" value="10">10</option>
                            <option value="25">25</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                        </select>
                        <select class="gotoPage" title="Номер страницы"></select>
                    </th>
                </tr>
            </tfoot>
            <tbody>
                @foreach($items as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->code }}</td>
                        <td>{{ $item->type }}</td>
                        <td>{{ $item->liters }}</td>
                        <td>{{ number_format($item->ticket_sold_price, 2, '.', ' ') }}</td>
                        <td>{{ $item->contractor }}</td>
                        <td>{{ $item->is_returned ? 'Да' : 'Нет' }}</td>
                        <td>{{ $item->gas_station }}</td>
                        <td>{{ $item->returned_at ? $item->returned_at->format('Y-m-d') : '' }}</td>
                        <td><a href="{{ route('admin.fuel_tickets.edit', $item->id) }}" class="btn btn-small waves-effect waves-light"><i class="material-icons">edit</i></a></td>
                        <td><button onclick="confirmDelete(this, '{{ $item->id }}')" class="btn btn-small waves-effect waves-light red darken-2"><i class="material-icons">delete</i></button></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <div class="no-items"></div>
    @endif
@endsection
