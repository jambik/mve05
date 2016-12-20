@extends('layouts.app')

@section('title', 'Список АЗС')
@section('keywords', '')
@section('description', '')

@section('content')
    @include('partials._status')
    @include('partials._errors')

    <h1>Список АЗС, партнеров MVE, принимающих талоны компании MVE</h1>

    <a name="map"></a>
    <div id="map" style="width: 100%; height: 500px;" class="hidden-print"></div>

    <script type="text/javascript">
        var azsObject = {
            "azs" : [
                @foreach($azs as $value)
                    @if ($value->lat && $value->lng)
                        {
                            "id" : "{{ $value->id }}",
                            "name" : "{{ $value->name }}",
                            "description" : "{{ $value->description }}",
                            "location" : "{{ $value->location }}",
                            "address" : "{{ $value->address }}",
                            "lat" : "{{ $value->lat }}",
                            "lng" : "{{ $value->lng }}"
                        },
                    @endif
                @endforeach
            ]
        };
    </script>

    <script type="text/javascript">
        var map;
        var openedInfoWindow = false;
        var infowindows = new Array();
        var markers     = new Array();

        function initMap()
        {
            map = new google.maps.Map(document.getElementById('map'), {
                center: {lat: 42.988841, lng: 47.489400},
                zoom: 12,
                streetViewControl: false
            });

            for (var i = 0; i < azsObject.azs.length; i++) {
                // Id записи
                var id = Number(azsObject.azs[i].id);

                // Создание окна информации о АЗС
                infowindows[id] = new google.maps.InfoWindow({
                    content: '<div style="font-weight: bolder; font-size: 150%; margin: 0 0 10px 0;">' + azsObject.azs[i].name + '</div>' +
                        '<p>' + azsObject.azs[i].description + '</p>' +
                        '<p>' + azsObject.azs[i].location + '</p>' +
                        '<p><strong>Адрес</strong>: ' + azsObject.azs[i].address + '</p>',
                    maxWidth: 400
                });

                // Создание маркера АЗС на карте
                var latLng = new google.maps.LatLng(azsObject.azs[i].lat, azsObject.azs[i].lng);
                markers[id] = new google.maps.Marker({
                    position: latLng,
                    map: map,
                    title: azsObject.azs[i].name,
                    index : id,
                    icon: '{{ asset('img/map-gas-station.png') }}'
                });
                markers[id].addListener('click', function() {
                    if (openedInfoWindow) {
                        openedInfoWindow.close();
                    }
                    infowindows[this.index].open(map, this);
                    openedInfoWindow = infowindows[this.index];
                });
            }
        }

        function showAzsOnMap(lat, lng, index)
        {
            document.location = '#map';
            var latLng = new google.maps.LatLng(lat, lng);

            map.panTo(latLng);
            map.setZoom(14);

            if (openedInfoWindow) {
                openedInfoWindow.close();
            }

            infowindows[index].open(map, markers[index]);
            openedInfoWindow = infowindows[index];
        }
    </script>

    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAau6IrQRAo4i8uT8aPexzKrVWzJgkwUJk&language=ru&callback=initMap"></script>

    <p>&nbsp;</p>

    <div class="text-center hidden-print">
        <button onclick="window.print()" class="btn btn-primary"><i class="fa fa-print"></i> - Распечатать список АЗС</button>
    </div>

    <p class="hidden-print">&nbsp;</p>

    <table class="table">
        <thead>
            <tr>
                <th>Место расположения</th>
                <th>Наименование АЗС</th>
                <th>Адрес</th>
                <th>&nbsp;</th>
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
                    <td style="width: 101px;">
                        @if ($value->lat && $value->lng)
                            <button onclick="showAzsOnMap('{{  $value->lat }}', '{{  $value->lng }}', {{ $value->id }})" class="btn btn-default"><i class="fa fa-map-marker"></i> карта</button>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="text-center hidden-print">
        <button onclick="window.print()" class="btn btn-primary"><i class="fa fa-print"></i> - Распечатать список АЗС</button>
    </div>

@endsection