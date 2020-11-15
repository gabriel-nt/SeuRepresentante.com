@extends('layouts.auth')

@section('content')
<div class="container" style="margin-top:80px">
    <div class="row justify-content-center">
        <div class=" col-sm-12 col-md-5">
            <h2 style="text-align:center; margin-bottom: 40px">Nova Senha</h2>
            <div class="card">

                <div class="card-body" style="padding: 30px 50px; background: #f3f2f2">

                    <p>Preencha os dados e digite a sua nova senha</p>

                    <form method="POST" action="{{ route('empresa.password.update') }}">
                        @csrf

                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="form-group col-12" style="padding:0">
                            <div class="input-container is-valid @error('email') is-invalid @enderror">
                                <input id="email" class="input" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus type="email" style="background: transparent"/>
                                <label class="label" for="email">Email</label>
                                @error('email')
                                <span class="validation">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>
                        </div>
    
                        <div class="form-group col-12" style="padding:0">
                            <div class="input-container is-valid @error('password') is-invalid @enderror">
                                <input id="password" class="input" type="password" name="password" autocomplete="new-password" value="{{old('password')}}" style="background: transparent;"/>
                                <label class="label" for="password">Senha</label>
                                @error('password')
                                <span class="validation">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="form-group col-12" style="padding:0">
                            <div class="input-container is-valid @error('password-confirm') is-invalid @enderror">
                                <input id="password-confirm" class="input" type="password" name="password_confirmation" value="{{old('password_confirmation')}}" autocomplete="new-password" style="background: transparent"/>
                                <label class="label" for="password-confirm">Confirme sua Senha</label>
                                @error('password-confirm')
                                <span class="validation">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>
                        </div>
                        
                        <hr style="border: 1px dashed grey; margin: 25px 0">

                        <div class="form-group row">
                            <div class="col-12">
                                <button type="submit" class="btn btn-warning text-white col-12 py-2">
                                    Modificar senha
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

