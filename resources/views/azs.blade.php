@extends('layouts.app')

@section('title', 'Список АЗС')
@section('keywords', '')
@section('description', '')

@section('content')
    @include('partials._status')
    @include('partials._errors')

    <h1>Список АЗС, партнеров MVE, принимающих талоны компании MVE</h1>

    <div id="map" style="width: 100%; height: 500px;"></div>

    <script type="text/javascript">
        var azsObject = {
            "azs" : [
                @foreach($azs as $value)
                {
                    "name" : "{{ $value->name }}",
                    "description" : "{{ $value->description }}",
                    "location" : "{{ $value->location }}",
                    "address" : "{{ $value->address }}",
                    "lat" : "{{ $value->lat }}",
                    "lng" : "{{ $value->lng }}"
                },
                @endforeach
            ]
        };
    </script>

    <script type="text/javascript">
        var map;

        function initMap()
        {
            map = new google.maps.Map(document.getElementById('map'), {
                center: {lat: 42.988841, lng: 47.489400},
                zoom: 12,
                streetViewControl: false
            });

            var infowindows = new Array();
            var markers = new Array();

            for (var i = 0; i < azsObject.azs.length; i++) {
                // Создание окна информации о АЗС
                infowindows[i] = new google.maps.InfoWindow({
                    content: '<div style="font-weight: bolder; font-size: 150%; margin: 0 0 10px 0;">' + azsObject.azs[i].name + '</div>' +
                        '<p>' + azsObject.azs[i].description + '</p>' +
                        '<p>' + azsObject.azs[i].location + '</p>' +
                        '<p><strong>Адрес</strong>: ' + azsObject.azs[i].address + '</p>',
                    maxWidth: 400
                });

                // Создание маркера АЗС на карте
                var latLng = new google.maps.LatLng(azsObject.azs[i].lat, azsObject.azs[i].lng);
                markers[i] = new google.maps.Marker({
                    position: latLng,
                    map: map,
                    title: azsObject.azs[i].name,
                    index : i,
                    icon: '{{ asset('img/map-gas-station.png') }}'
                });
                markers[i].addListener('click', function() {
                    for (var j = 0; j < infowindows.length; j++ ) {
                        infowindows[j].close();
                    }
                    infowindows[this.index].open(map, this);
                });
            }
        }
    </script>

    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAau6IrQRAo4i8uT8aPexzKrVWzJgkwUJk&language=ru&callback=initMap"></script>

    <p>&nbsp;</p>

    <table class="table">
        <thead>
            <tr>
                <th>Место расположения</th>
                <th>Наименование АЗС</th>
                <th>Адрес</th>
            </tr>
        </thead>
        <tbody>
            @foreach($azs as $value)
                <tr>
                    <td>{{ $value->location }}</td>
                    <td>
                        {{ $value->name }}
                        {!! $value->description ? "<div class='small'>".$value->description.'</div>' : '' !!}
                    </td>
                    <td>{{ $value->address }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

@endsection