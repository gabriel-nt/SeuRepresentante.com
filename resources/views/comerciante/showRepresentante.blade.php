@extends('layouts.dashboard')

@section('title')
    <title>Perfil do Vendedor</title>
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

@include('comerciante.side-menu')

@section('content')
    <div class="accordion" id="accordion">
        <nav aria-label="breadcrumb">
            <div class="row">
                <div class="col px-3 tx-c" id="show-location">
                    <a class="menu-item" href="#" onclick="ul(0)" data-toggle="collapse" data-target="#more-location" aria-expanded="true" aria-controls="more-location">Localização</a>
                </div>
                <div class="col px-3 tx-c" id="show-products">
                    <a class="menu-item" href="#" onclick="ul(1)" data-toggle="collapse" data-target="#more-products" aria-expanded="false" aria-controls="more-products">Produtos</a>
                </div>
                <div class="col px-3 tx-c" id="show-profile">
                    <a class="menu-item" href="#" onclick="ul(2)" data-toggle="collapse" data-target="#more-profile" aria-expanded="false" aria-controls="more-profile">Perfil</a>
                </div>

                <div class="underline"></div>
            </div>      
        </nav>
        <div>
            <div id="more-profile" class="collapse" aria-labelledby="show-profile" data-parent="#accordion">
                <div class="row py-5 px-4">
                    <div class="col-lg-6 col-md-8 col-sm-10 mx-auto">  
                        <div class="bg-white shadow rounded overflow-hidden">
                            <div class="pt-5 px-4 pt-0 pb-4 bg-dark" style="background-image: url({{ asset('img/thumbnail.jpg') }})">
                                <div class="media align-items-end profile-header">
                                    <div class="profile mr-3">
                                            @if($representante->imagem)
                                            <img src="{{ asset($representante->imagem) }}" style="width:170px" class="rounded mb-2 img-thumbnail">
                                            @else
                                            <img src="{{ asset('img/sem-foto-perfil.jpg') }}" style="width:170px" class="rounded mb-2 img-thumbnail">
                                            @endif
                                    <a href="#" class="btn btn-dark btn-sm btn-block">Chat</a></div>
                                    <div class="media-body mb-5 text-white">
                                        <h4 class="mt-0 mb-1">{{$representante->nome}}</h4>
                                        <p class="small mb-4" style="text-transform: uppercase"> <i class="fa fa-map-marker mr-2"></i>{{$representante->typeUser}}</p>
                                    </div>
                                </div>
                            </div>
                
                            <div class="bg-light p-4 d-flex justify-content-end text-center">
                                <ul class="list-inline mb-0">
                                    <li class="list-inline-item">
                                    <h5 class="font-weight-bold mb-0 d-block"><i class="far fa-calendar-alt mr-2"></i>Cadastrado em:</h5><small class="text-muted"> {{ date( 'd/m/Y' , strtotime($representante->created_at))}}</small>
                                    </li>
                                </ul>
                            </div>
                
                            <div class="py-4 px-4">
                                <h5 class="mb-3"><i class="fas fa-info-circle mr-2"></i>Informações</h5>
                                <div class="p-4 bg-light rounded shadow-sm">
                                <p class="font-italic mb-3">{{$representante->descricao}}</p>
                                    <p class="font-italic mb-0"><i class="fas fa-lg fa-envelope mr-2"></i> Email: {{$representante->email}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> 
            </div>
        </div>
        <div>
            <div id="more-products" class="collapse" aria-labelledby="show-products" data-parent="#accordion">
                <div class="panel panel-primary mt-4">
                    <div class="panel-heading">
                        <div class="row">
                            <h3 class="col panel-title">Produtos</h3>
                            <div class="col ft-ct">
                                <span class="filter" data-toggle="tooltip" title="Abrir ou esconder o campo de pesquisa" data-container="body">
                                    <i class="fas fa-filter"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="input-container">
                            <input id="search" name='search' class="input" type="text" />
                            <label class="label" for="search">Pesquise por produtos</label>
                        </div> 
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover table-striped table-borderless table-valign-middle tb" style="margin-bottom: 0" id="dev-table">
                            <thead class="tx-c">
                                <tr>
                                    <th>Nome</th>
                                    <th>Preço</th>
                                    <th>Imagem</th>
                                    <th>Opções</th>
                                </tr>
                            </thead>
                            <tbody class="tx-c">
    
                                @foreach ($produtos as $produto)
                                <tr>
                                    <td>{{$produto->nome}}</td>
                                    <td>R$ {{$produto->valor}}</td>
                                    <td>
                                        <span class="img-profile" style="width: 60px; height: 60px; background-image: url( {{ asset($produto->imagem)}})"></span>
                                    </td>
                                    <td>
                                        <a href="{{ route('produto.show', ['id' => $produto->id ])}}" class="btn btn-rounded waves-effect btn-if">Visualizar</a>        
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div>
            <div id="more-location" class="collapse show" aria-labelledby="show-location" data-parent="#accordion">
                <div class="card-body" style="font-family: 'Open Sans'">

                    <p class="mb-0">Minha Atual Localização:</p>
                    @if(count($localizacao) > 0)
                    @foreach ($localizacao as $info)
                        @if($info->rua)
                        <p class="mb-0"><b> - Rua: {{$info->rua}}</b>,</p>
                        @else 
                        <p class="mb-0"><b> - Rua: Não informada</b>,</p>
                        @endif
                        @if($info->bairro)
                        <p class="mb-0"><b> - Bairro: {{$info->bairro}}</b>,</p>
                        @else 
                        <p class="mb-0"><b> - Bairro: Não informado</b>,</p>
                        @endif
                        @if($info->cidade)
                        <p class="mb-0"><b> - Cidade:{{$info->cidade}}</b>,</p>
                        @else 
                        <p class="mb-0"><b> - Cidade: Não informada</b>,</p>
                        @endif
                        @if($info->estado)
                        <p class="mb-0"><b> - UF: {{$info->estado}}</b></p>
                        @else 
                        <p class="mb-0"><b> - UF: Não informado</b></p>
                        @endif
                        <input type="hidden" id="rua" value="{{$info->rua}}"/>
                        <input type="hidden" id="complemento" value="{{$info->complemento}}"/>
                        <input type="hidden" id="bairro" value="{{$info->bairro}}"/>
                        <input type="hidden" id="cidade" value="{{$info->cidade}}"/>
                        <input type="hidden" id="estado" value="{{$info->estado}}"/>
                    @endforeach

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
            </div>
        </div>
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