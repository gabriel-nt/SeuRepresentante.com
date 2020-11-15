@extends('layouts.app')

@section('title')
    <title>Cadastro de Usuário</title>
@endsection

@section('content')
    <div class="container">
        <div class="col-12 mb-2">
            <center>
                <div class="about">
                    <i class="far fa-building icone"></i>
                    <h2 style="font-family: League Gothic">Empresa</h2>
                    <p>Criação de Perfil</p>
                </div>
            </center>
                <form action="{{ route('empresa.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                    <div class="form-row">
                        <div class="form-group col-7">
                            <div class="input-container is-valid @error('name') is-invalid @enderror">
                                <input id="name" name="name" class="input" value="{{old('name')}}" type="text" required />
                                <label class="label" for="name">Nome</label>
                                @error('name')
                                <span class="validation">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group col-5">
                            <div class="input-container is-valid @error('cnpj') is-invalid @enderror">
                                <input id="cnpj" name="cnpj" class="input" value="{{old('cnpj')}}" type="text" required />
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
                        <div class="form-group col-12">
                            <div class="input-container is-valid @error('endereco') is-invalid @enderror">
                                <input id="endereco" name="endereco" class="input" value="{{old('endereco')}}" type="text" required />
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
                        <div class="form-group col-6">
                            <div class="input-container is-valid @error('password') is-invalid @enderror">
                                <input id="password" class="input" type="password" name="password" autocomplete="new-password" value="{{old('password')}}"/>
                                <label class="label" for="password">Senha</label>
                                @error('password')
                                <span class="validation">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group col-6">
                            <div class="input-container is-valid @error('password-confirm') is-invalid @enderror">
                                <input id="password-confirm" class="input" type="password" name="password_confirmation" value="{{old('password_confirmation')}}" autocomplete="new-password"/>
                                <label class="label" for="password-confirm">Confirme sua Senha</label>
                                @error('password-confirm')
                                <span class="validation">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="form-row justify-content-center">
                        <div class="form-group col-sm-12 col-md-6 profile">
                        </div>
                    </div>

                    <div>
                        <button type="submit" class="btn btn-sc btn-md mr-1">Cadastrar</button>
                        <a href="{{route('index')}}" class="btn btn-md btn-dg">Cancelar</a>
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
        $('.profile').append(inputImage.getView());
    </script>
@endsection
