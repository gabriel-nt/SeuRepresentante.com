@extends('layouts.dashboard')

@section('title')
    <title>Minha Localização</title>
@endsection

@section('css')
    <link rel="stylesheet" type="text/css" href="https://js.api.here.com/v3/3.1/mapsjs-ui.css" />
    <style>
        #map {
            display: block;
            width: 100%;
            margin-bottom: 10px;
            height: 450px;
            background: grey;
        }
    </style>
@endsection

@include('representante.side-menu')

@section('content')
    <div>
        <div class="mb-3 mt-2 title-request">Minha Localização</div>
        @if($endereco)
        @if($endereco->rua)
        <p class="mb-0"><b> - Rua: {{$endereco->rua}}</b>,</p>
        @else 
        <p class="mb-0"><b> - Rua: Não informada</b>,</p>
        @endif
        @if($endereco->bairro)
        <p class="mb-0"><b> - Bairro: {{$endereco->bairro}}</b>,</p>
        @else 
        <p class="mb-0"><b> - Bairro: Não informado</b>,</p>
        @endif
        @if($endereco->cidade)
        <p class="mb-0"><b> - Cidade: {{$endereco->cidade}}</b>,</p>
        @else 
        <p class="mb-0"><b> - Cidade: Não informada</b>,</p>
        @endif
        @if($endereco->estado)
        <p><b> - UF: {{$endereco->estado}}</b></p>
        @else 
        <p><b> - UF: Não informado</b></p>
        @endif
        <input type="hidden" id="rua" value="{{$endereco->rua}}"/>
        <input type="hidden" id="complemento" value="{{$endereco->complemento}}"/>
        <input type="hidden" id="bairro" value="{{$endereco->bairro}}"/>
        <input type="hidden" id="cidade" value="{{$endereco->cidade}}"/>
        <input type="hidden" id="estado" value="{{$endereco->estado}}"/>

        <div id="map">

        </div>
        @else
        <div class="face">
            <div class="band">
                <div class="red"></div>
                <div class="white"></div>
                <div class="blue"></div>
            </div>
            <div class="eyes"></div>
            <div class="dimples"></div>
            <div class="mouth"></div>
        </div>
        
        <h1 class="result-none">Oops! Localização não definida!</h1>
        @endif
    </div>
@endsection

@section('javascript')
    <script type="text/javascript" src="https://js.api.here.com/v3/3.1/mapsjs-core.js"></script>
    <script type="text/javascript" src="https://js.api.here.com/v3/3.1/mapsjs-service.js"></script>
    <script type="text/javascript" src="https://js.api.here.com/v3/3.1/mapsjs-ui.js"></script>
    <script type="text/javascript" src="https://js.api.here.com/v3/3.1/mapsjs-mapevents.js"></script>
    <script>
        $(document).ready(function() {
            $('[data-toggle="tooltip"]').tooltip();
            $('.filter').on('click', function(e){
                let $this = $(this);
                let $panel = $this.parents('.panel');  
                $panel.find('.panel-body').slideToggle();
            });
        });

        function ul(index) {
            var underlines = document.querySelectorAll(".underline");
            for (var i = 0; i < underlines.length; i++) {
                underlines[i].style.transform = 'translate3d(' + index * 100 + '%,0,0)';
            }
        }

         // Captura os valores da localização
         let rua = $('#rua').val();
            let bairro = $('#bairro').val();
            let cidade = $('#cidade').val();
            let estado = $('#estado').val();

            let address = rua + ', ' + bairro + ', ' + cidade + ', ' + estado;
            function geocode(platform) {
                var geocoder = platform.getGeocodingService(),
                geocodingParameters = {
                    searchText: address,
                    jsonattributes: 1
                };

                geocoder.geocode(
                    geocodingParameters,
                    onSuccess,
                    onError
                );
            }

            function onSuccess(result) {
                var locations = result.response.view[0].result;
                addLocationsToMap(locations);
                addLocationsToPanel(locations);
            }

            function onError(error) {
                alert('Can\'t reach the remote server');
            }

            var platform = new H.service.Platform({
                apikey: 'styV-vQKzSCuXd5Hus0_aCCj8-181G7CnZOmRoyHsC4'
            });
            var defaultLayers = platform.createDefaultLayers();
            var map = new H.Map(document.getElementById('map'),
                defaultLayers.vector.normal.map, {
                    center: {
                        lat: 37.376,
                        lng: -122.034
                    },
                    zoom: 13,
                    pixelRatio: window.devicePixelRatio || 1
                });

            window.addEventListener('resize', () => map.getViewPort().resize());

            var behavior = new H.mapevents.Behavior(new H.mapevents.MapEvents(map));

            var ui = H.ui.UI.createDefault(map, defaultLayers);

            var bubble;

            function openBubble(position, text) {
                if (!bubble) {
                    bubble = new H.ui.InfoBubble(
                        position, {
                            content: text
                        });
                    ui.addBubble(bubble);
                } else {
                    bubble.setPosition(position);
                    bubble.setContent(text);
                    bubble.open();
                }
            }

            function addLocationsToPanel(locations) {

                var nodeOL = document.createElement('ul'),
                    i;

                nodeOL.style.fontSize = 'small';
                nodeOL.style.marginLeft = '5%';
                nodeOL.style.marginRight = '5%';

                for (i = 0; i < locations.length; i += 1) {
                    var li = document.createElement('li'),
                        divLabel = document.createElement('div'),
                        address = locations[i].location.address,
                        content = '' + address.label + '';
                    position = {
                        lat: locations[i].location.displayPosition.latitude,
                        lng: locations[i].location.displayPosition.longitude
                    };

                    content += 'houseNumber: ' + address.houseNumber + '';
                    content += 'street: ' + address.street + '';
                    content += 'district: ' + address.district + '';
                    content += 'city: ' + address.city + '';
                    content += 'postalCode: ' + address.postalCode + '';
                    content += 'county: ' + address.county + '';
                    content += 'country: ' + address.country + '';
                    content += 'position: ' +
                        Math.abs(position.lat.toFixed(4)) + ((position.lat > 0) ? 'N' : 'S') +
                        ' ' + Math.abs(position.lng.toFixed(4)) + ((position.lng > 0) ? 'E' : 'W');

                    divLabel.innerHTML = content;
                    li.appendChild(divLabel);

                    nodeOL.appendChild(li);
                }
            }

            function addLocationsToMap(locations) {
                var group = new H.map.Group(),
                    position,
                    i;

                for (i = 0; i < locations.length; i += 1) {
                    position = {
                        lat: locations[i].location.displayPosition.latitude,
                        lng: locations[i].location.displayPosition.longitude
                    };
                    marker = new H.map.Marker(position);
                    marker.label = locations[i].location.address.label;
                    group.addObject(marker);
                }

                group.addEventListener('tap', function(evt) {
                    map.setCenter(evt.target.getGeometry());
                    openBubble(
                        evt.target.getGeometry(), evt.target.label);
                }, false);

                map.addObject(group);
                map.setCenter(group.getBoundingBox().getCenter());
            }

            geocode(platform);
    </script>
@endsection