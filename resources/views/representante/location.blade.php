@extends('layouts.dashboard')

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

@section('title')
    <title>Definir localização</title>
@endsection

@include('representante.side-menu')

@section('content')
    <div class="container">
        <div class="col-12 mb-2">
            <center>
                <div class="about">
                    <i class="icone fas fa-search-location"></i>
                    <h2 style="font-family: League Gothic">Localização</h2>
                    <p>Definir a localização atual do representante</p>
                </div>
            </center>
                <form action="{{ route('representante.storeLocation')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-row">
                        <div class="form-group col-sm-12 col-md-4">
                            <div class="input-container is-valid @error('CEP') is-invalid @enderror">
                                <input id="cep" name='CEP' class="input" value="{{old('CEP')}}" type="text" />
                                <label class="label" for="cep">CEP</label>
                                @error('CEP')
                                <span class="validation">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>               
                        </div>
                        <div class="form-group col-sm-12 col-md-8">
                            <div class="input-container is-valid @error('rua') is-invalid @enderror">
                                <input id="rua" name='rua' class="input" value="{{old('rua')}}" type="text"/>
                                <label class="label" for="rua">Rua</label>
                                @error('rua')
                                <span class="validation">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-sm-12 col-md-12">
                            <div class="input-container is-valid @error('complemento') is-invalid @enderror">
                                <input id="complemento" name='complemento' class="input" value="{{old('complemento')}}"type="text"/>
                                <label class="label" for="complemento">Complemento</label>
                                @error('complemento')
                                <span class="validation">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-sm-12 col-md-6">
                            <div class="input-container is-valid @error('bairro') is-invalid @enderror">
                                <input id="bairro" name='bairro' class="input" value="{{old('bairro')}}" type="text"/>
                                <label class="label" for="bairro">Bairro</label>
                                @error('bairro')
                                <span class="validation">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group col-sm-12 col-md-6">
                            <div class="input-container is-valid @error('cidade') is-invalid @enderror">
                                <input id="cidade" class="input" name='cidade' value="{{old('cidade')}}"type="text" />
                                <label class="label" for="cidade">Cidade</label>
                                @error('cidade')
                                <span class="validation">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-sm-12 col-md-6">
                            <div class="input-container is-valid @error('estado') is-invalid @enderror">
                                <input id="estado" class="input" type="text" name="estado"  value="{{old('estado')}}"/>
                                <label class="label" for="estado">Estado</label>
                                @error('estado')
                                <span class="validation">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group col-sm-12 col-md-6">
                            <div class="input-container is-valid @error('ibge') is-invalid @enderror">
                                <input id="ibge" class="input" type="text" name="ibge" value="{{old('ibge')}}"/>
                                <label class="label" for="ibge">IBGE</label>
                                @error('ibge')
                                <span class="validation">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div id="map" class="dp-hd">

                    </div>

                    <div>
                        <button type="submit" class="btn btn-sc btn-md mr-1">Definir</button>
                        <a href="{{route('index')}}" class="btn btn-md btn-dg">Cancelar</a>
                    </div> 
                </form>
        </div>
    </div>
@endsection

@section('javascript')
    <script>
        $(document).ready(function() {

            $('#cep').inputmask("99999-999");

            let rua = $("#rua");
            let bairro = $("#bairro");
            let cidade = $("#cidade");
            let ibge = $("#ibge");
            let estado = $("#estado");
            let complemento = $("#complemento");

            function limpa_formulário_cep() {
                rua.val("");
                rua.siblings().removeClass('is-active-label');
                bairro.val("");
                bairro.siblings().removeClass('is-active-label');
                cidade.val("");
                cidade.siblings().removeClass('is-active-label');
                ibge.val("");
                ibge.siblings().removeClass('is-active-label');
                estado.val("");
                estado.siblings().removeClass('is-active-label');
                complemento.val("");
                complemento.siblings().removeClass('is-active-label');
                $('#map').addClass('dp-hd');
            }

            $("#cep").blur(function() {

                var cep = $(this).val().replace(/\D/g, '');

                if (cep != "") {

                    var validacep = /^[0-9]{8}$/;

                    if(validacep.test(cep)) {

                        rua.val("...");
                        rua.siblings().addClass('is-active-label');
                        bairro.val("...");
                        bairro.siblings().addClass('is-active-label');
                        cidade.val("...");
                        cidade.siblings().addClass('is-active-label');
                        ibge.val("...");
                        ibge.siblings().addClass('is-active-label');
                        estado.val("...");
                        estado.siblings().addClass('is-active-label');
                        complemento.val("...");
                        complemento.siblings().addClass('is-active-label');

                        $.getJSON("https://viacep.com.br/ws/"+ cep +"/json/?callback=?", function(dados) {

                            if (!("erro" in dados)) {
                                if (dados.logradouro != '') {
                                    rua.val(dados.logradouro);
                                } else {
                                    rua.val('');
                                    rua.siblings().removeClass('is-active-label');
                                }

                                if (dados.bairro != '') {
                                    bairro.val(dados.bairro);
                                } else {
                                    bairro.val('');
                                    bairro.siblings().removeClass('is-active-label');
                                }

                                if (dados.localidade != '') {
                                    cidade.val(dados.localidade);
                                } else {
                                    cidade.val('');
                                    cidade.siblings().removeClass('is-active-label'); 
                                }

                                if (dados.uf != '') {
                                    estado.val(dados.uf);
                                } else {
                                    estado.val('');
                                    estado.val("").siblings().removeClass('is-active-label');
                                }

                                if (dados.ibge != '') {
                                    ibge.val(dados.ibge);
                                } else {
                                    ibge.val('');
                                    ibge.val("").siblings().removeClass('is-active-label');
                                }  
                                
                                if (dados.complemento != '') {
                                    complemento.val(dados.complemento);
                                } else {
                                    complemento.val('');
                                    complemento.val("").siblings().removeClass('is-active-label');
                                } 

                                let address = dados.logradouro + ', ' + dados.bairro + ', ' + dados.localidade + ', ' + dados.uf;
                                $('#map').html('');
                                $('#map').removeClass('dp-hd');
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

                            } else {
                                limpa_formulário_cep();
                                alert("cep não encontrado.");
                            }
                        });
                    } 
                    else {
                        limpa_formulário_cep();
                        alert("Formato de cep inválido.");
                    }
                } 
                else {
                    limpa_formulário_cep();
                }
            }); 
        });
    </script>
    <script type="text/javascript" src="https://js.api.here.com/v3/3.1/mapsjs-core.js"></script>
    <script type="text/javascript" src="https://js.api.here.com/v3/3.1/mapsjs-service.js"></script>
    <script type="text/javascript" src="https://js.api.here.com/v3/3.1/mapsjs-ui.js"></script>
    <script type="text/javascript" src="https://js.api.here.com/v3/3.1/mapsjs-mapevents.js"></script>
@endsection