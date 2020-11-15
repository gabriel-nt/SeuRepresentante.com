@extends('layouts.dashboard')

@section('title')
    <title>Atualização de Perfil</title>
@endsection

@include('representante.side-menu')

@section('content')
    <div class="container">
        <div class="col-12 mb-2">
            <center>
                <div class="about">
                    <i class="far fa-user-circle icone"></i>
                    <h2 style="font-family: League Gothic">Representante</h2>
                    <p>Atualização de Perfil</p>
                </div>
            </center>
                    <form action="{{ route('representante.update', [$representante->id])}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-row">
                        <div class="form-group col-sm-12 col-md-7">
                            <div class="input-container is-valid @error('name') is-invalid @enderror">
                                <input id="name" name='name' class="input" value="{{old('representante', $representante->nome)}}" type="text" />
                                <label class="label" for="name">Nome</label>
                                @error('name')
                                <span class="validation">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>               
                        </div>
                        <div class="form-group col-sm-12 col-md-5">
                            <div class="input-container is-valid @error('cpf') is-invalid @enderror">
                                <input id="cpf" name='cpf' class="input" value="{{old('representante', $representante->CPF)}}"" type=""/>
                                <label class="label" for="cpf">CPF</label>
                                @error('cpf')
                                <span class="validation">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-sm-12 col-md-12">
                            <div class="input-container is-valid @error('descricao') is-invalid @enderror">
                                <textarea id="descricao" rows="3" name='descricao' class="input">{{old('descricao')}}</textarea>
                                <label class="label" for="descricao">Breve Descrição</label>
                                @error('descricao')
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
                                <input id="email" name='email' class="input" value="{{old('representante', $representante->email)}}" type="email"/>
                                <label class="label" for="email">Email</label>
                                @error('email')
                                <span class="validation">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group col-sm-12 col-md-6">
                            <div class="input-container is-valid @error('tipo') is-invalid @enderror">
                                <input id="tipo" class="input" name='tipo' value="{{old('representante', $representante->tipoProduto)}}"type="text" />
                                <label class="label" for="tipo">Produto</label>
                                @error('tipo')
                                <span class="validation">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="form-row">
                        @if($representante->imagem)
                        <div class="col-sm-12 col-md-6 profile-edit">
                            <p>Sua imagem de perfil atual, caso queria mudar, basta clicar no campo ao lado.</p>
                            <img src="{{ asset($representante->imagem)}}" class="img-fluid" style="max-height:200px" alt="profile">
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
                        <a href="{{route('representante.dashboard')}}" class="btn btn-md btn-dg">Cancelar</a>
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
