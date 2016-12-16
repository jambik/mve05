@extends('admin.page', ['title' => "Список АЗС"])

@section('content')
    <h4 class="center">Список АЗС</h4>
    <p><a href="{{ route('admin.azs.create') }}" class="btn waves-effect waves-light"><i class="material-icons left">add_circle</i> Добавить</a></p>

    @if ($items->count())
        <table id="table_items">
            <thead>
                <tr>
                    <th class="filter-false btn-collumn" data-sorter="false"></th>
                    <th>Id</th>
                    <th>Название АЗС</th>
                    <th>Описание</th>
                    <th>Место расположения</th>
                    <th>Адрес</th>
                    <th>Широта, Долгота</th>
                    <th class="filter-false btn-collumn" data-sorter="false"></th>
                    <th class="filter-false btn-collumn" data-sorter="false"></th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th colspan="9" class="pager form-inline">
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
            <tbody class="sortable" data-entity-name="azs">
                @foreach($items as $item)
                    <tr data-item-id="{{ $item->id }}">
                        <td class="sortable-handle"><i class="material-icons">&#xE240;</i></td>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->description }}</td>
                        <td>{{ $item->location }}</td>
                        <td>{{ $item->address }}</td>
                        <td>{{ $item->lat }}, {{ $item->lng }}</td>
                        <td><a href="{{ route('admin.azs.edit', $item->id) }}" class="btn btn-small waves-effect waves-light"><i class="material-icons">edit</i></a></td>
                        <td><button onclick="confirmDelete(this, '{{ $item->id }}')" class="btn btn-small waves-effect waves-light red darken-2"><i class="material-icons">delete</i></button></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <div class="no-items"></div>
    @endif
@endsection
