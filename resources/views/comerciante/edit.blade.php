@extends('layouts.dashboard')

@section('title')
    <title>Atualização de Perfil</title>
@endsection

@include('comerciante.side-menu')

@section('content')
    <div class="container">
        <div class="col-12 mb-2">
            <center>
                <div class="about">
                    <i class="far fa-user-circle icone"></i>
                    <h2 style="font-family: League Gothic">Comerciante</h2>
                    <p>Atualização de Perfil</p>
                </div>
            </center>
                    <form action="{{ route('comerciante.update', [$comerciante->id])}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-row">
                        <div class="form-group col-sm-12 col-md-7">
                            <div class="input-container is-valid @error('razaoSocial') is-invalid @enderror">
                                <input id="razaoSocial" name='razaoSocial' class="input" value="{{old('comerciante', $comerciante->razaoSocial)}}" type="text" />
                                <label class="label" for="razaoSocial">Razão Social</label>
                                @error('razaoSocial')
                                <span class="validation">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>               
                        </div>
                        <div class="form-group col-sm-12 col-md-5">
                            <div class="input-container is-valid @error('cnpj') is-invalid @enderror">
                                <input id="cnpj" name='cnpj' class="input" value="{{old('comerciante', $comerciante->CNPJ)}}""type=""/>
                                <label class="label" for="cnpj">CNPJ</label>
                                @error('cnpj')
                                <span class="validation">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-sm-12 col-md-6">
                            <div class="input-container is-valid @error('email') is-invalid @enderror">
                                <input id="email" name='email' class="input" value="{{old('comerciante', $comerciante->email)}}" type="email"/>
                                <label class="label" for="email">Email</label>
                                @error('email')
                                <span class="validation">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group col-sm-12 col-md-6">
                            <div class="input-container is-valid @error('endereco') is-invalid @enderror">
                                <input id="endereco" class="input" name='endereco' value="{{old('comerciante', $comerciante->endereco)}}"type="text" />
                                <label class="label" for="endereco">Endereço</label>
                                @error('endereco')
                                <span class="validation">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="form-row">
                        @if($comerciante->imagem)
                        <div class="col-sm-12 col-md-6 profile-edit">
                            <p>Sua imagem de perfil atual, caso queria mudar, basta clicar no campo ao lado.</p>
                            <img src="{{ asset($comerciante->imagem)}}" class="img-fluid" style="max-height:200px" alt="profile">
                        </div>
                        @else
                        <div class="col-sm-12 col-md-6 profile-edit">
                            <p>Você não possui uma foto de perfil. Abaixo, a sua foto de perfil temporária.</p>
                            <img src="{{ asset('img/sem-foto-perfil.jpg')}}" class="img-fluid img-thumbnail" style="max-height:200px" alt="profile">
                        </div> 
                        @endif
                        <div class="form-group col-sm-12 col-md-6 profile">
                        </div>
                    </div>

                    <div>
                        <button type="submit" class="btn btn-sc btn-md mr-1">Atualizar</button>
                        <a href="{{route('comerciante.dashboard')}}" class="btn btn-md btn-dg">Cancelar</a>
                    </div>   
                </form>
        </div>
    </div>

    <div class="modal fade" id="modal-crop" tabindex="-1" role="dialog" aria-labelledby="modal-register-label" aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog modal-dialog-centered" role="document" style="width: 600px">
            <div class="modal-content">
                <div class="modal-body">           
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-danger cancel">Cancelar</button>
                    <button type="button" class="btn btn-success crop">Cortar</button>
                </div>
            </div>
            
        </div>
    </div>
@endsection

@section('javascript')
    <script>
        let inputImage = new InputImage();
        inputImage.init();
        // inputImage.getView().addClass('is-valid @error("imagemProfile") is-invalid @enderror')
        $('.profile').append(inputImage.getView());
    </script>
@endsection
