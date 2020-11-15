@extends('layouts.auth')

@section('content')
<div class="container" style="margin-top:130px">
    <div class="row justify-content-center">
        <div class=" col-sm-12 col-md-5">
            <h2 style="text-align:center; margin-bottom: 40px">Esqueceu sua senha?</h2>
            <div class="card">

                <div class="card-body" style="padding: 30px 50px; background: #f3f2f2">
                    
                    @include('partials.alerts')

                    <p>Informe seu email e receberá um link para alterar a sua senha</p>

                    <form method="POST" action="{{ route('empresa.password.email') }}">
                        @csrf
                        <div class="form-group">
                            <div class="input-container is-valid @error('email') is-invalid @enderror">
                                <input id="email" name='email' class="input" value="{{old('email')}}"type="email" style="background: transparent"/>
                                <label class="label" for="email">Email Cadastrado no site</label>
                                @error('email')
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
                                    Enviar Link
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


