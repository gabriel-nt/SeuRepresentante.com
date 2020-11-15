<!doctype html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        @yield('title')

        <link rel="shortcut icon" type="imagem/x-icon" href="{{asset('img/favicon.ico')}}" />
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.2/css/all.css" rel="stylesheet">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link type="text/css" rel="stylesheet" href="{{ asset('css/style.css') }}"  media="screen,projection"/>
    </head>
    <body>
    <div class="col-12 barra"></div>
        <nav class="navbar navbar-expand-lg navbar-light nav-app">
            <div class="container">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Alterna navegação">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <img src="{{ asset('img/logoTCC.png') }}" class="img-fluid" style="width:220px"/>
        
                <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
                    <ul class="navbar-nav ml-auto pt-2 nav-app">
                        <li class="nav-item">
                            <a class="nav-link" href="/">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/sobre">Sobre</a>
                        </li>
                        @guest
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="modal" data-target="#modal-register" href="#">Cadastre-se</a>
                        </li>                       
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="modal" data-target="#modal-selected" href="#">Login</a>
                        </li>
                    </ul>
                </div>
                @else
                <div class="btn-img">
                    <button href="#" class="btn-img" role="button" id="dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <div class="img-ct">
                            @if( Auth::user()->imagem == null)
                            <span class="img-profile" style="width: 32px; height: 32px; background-image: url({{ asset('img/sem-foto-perfil.jpg') }})"></span>
                            @else
                            <span class="img-profile" style="width: 32px; height: 32px; background-image: url( {{ asset(Auth::user()->imagem)}})"></span>
                            @endif
                        </div>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown">
                        @if(Auth::user()->typeUser == 'comerciante')
                        <label class="name-profile">{{ Auth::user()->razaoSocial }}</label>
                        @else
                        <label class="name-profile">{{ Auth::user()->nome }}</label>
                        @endif
                        <div class="dropdown-divider" style="margin:0 !important; margin-bottom: 5em"></div>
                        <a class="dropdown-item" href="{{ route(Auth::user()->typeUser.'.dashboard')}}">Dashboard</a>                               
                        <a class="dropdown-item" href="{{ route(Auth::user()->typeUser.'.show', ['id' => Auth::user()->id ])}}">Ver Perfil</a>
                        <a class="dropdown-item" href="{{ route(Auth::user()->typeUser.'.edit', ['id' => Auth::user()->id ])}}">Atualizar Perfil</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{ route('logout') }}"
                        onclick="event.preventDefault();document.getElementById('logout-form').submit();">Sair</a>

                        <form id="logout-form" action="{{ url('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div> 
                </div>    
                @endguest
            </div>
        </nav>

        <main>
            @yield('content')
        </main>        

      <!-- Footer -->
      <footer class="page-footer font-small unique-color-dark">

        <div style="background-color: #a6ca4a">
            <div class="container">

                <div class="row py-4 d-flex align-items-center">

                    <div class="col-md-6 col-lg-5 text-center text-md-left mb-4 mb-md-0">
                        <h6 class="mb-0">Siga nossas Rede Sociais!</h6>
                    </div>

                    <div class="col-md-6 col-lg-7 text-center text-md-right">
                        <a>
                            <i class="fab fa-facebook-f white-text mr-4"></i>
                        </a>
                        <a>
                            <i class="fab fa-instagram white-text mr-4"></i>
                        </a>
                        <a>
                            <i class="fab fa-google-plus-g white-text mr-4"></i>
                        </a>
                        <a>
                            <i class="fab fa-github white-text mr-4"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="container text-center text-md-left mt-5">

            <div class="row mt-3">
                <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
                    <h6 class="text-uppercase font-weight-bold">SeuRepresentante</h6>
                    <hr class="deep-green accent-2 mb-4 mt-0 d-inline-block mx-auto" style="width: 60px;">
                    <p>O software visa melhorar as relações comerciais entre vendendores e comerciantes, trazendo beneficios para ambos os lados.</p>
                </div>

                <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4">
                    <h6 class="text-uppercase font-weight-bold">Links</h6>
                    <hr class="deep-green accent-2 mb-4 mt-0 d-inline-block mx-auto" style="width: 60px;">
                    <p>
                        <a href="{{url('/sobre')}}" class="footer-link">Sobre</a>
                    </p>
                    <p>
                        <a href="{{url('/sobre#benCom')}}" class="footer-link">Beneficios Comerciante</a>
                    </p>
                    <p>
                        <a href="{{url('/sobre#benVen')}}" class="footer-link">Beneficios Vendedor</a>
                    </p>
                    <p>
                        <a href="#!" class="footer-link">Políticas de Uso</a>
                    </p>
                </div>

                <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4">
                    <h6 class="text-uppercase font-weight-bold">Outros Links</h6>
                    <hr class="deep-green accent-2 mb-4 mt-0 d-inline-block mx-auto" style="width: 60px;">
                    <p>
                        <a href="#!">Sua Conta</a>
                    </p>
                    <p>
                        <a href="#!">Ajuda!</a>
                    </p>
                </div>

                <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
                    <h6 class="text-uppercase font-weight-bold">Contatos</h6>
                    <hr class="deep-green accent-2 mb-4 mt-0 d-inline-block mx-auto" style="width: 60px;">
                    <p>
                        <i class="fas fa-home mr-3"></i> Taquara, Rio Grande do Sul
                    </p>
                    <p>
                        <i class="fas fa-envelope mr-3"></i> seurepresentante@gmail.com
                    </p>
                    <p>
                        <i class="fas fa-phone mr-3"></i> + 55 51 99999-9999
                    </p>
                </div>
            </div>
        </div>

        <div class="footer-copyright text-center py-3">© 2019 Copyright:
            <a href="#"> seurepresentante.com</a>
        </div>

    </footer>

    <!-- Modal -->
    <div class="modal fade" id="modal-login-empresa" tabindex="-1" role="dialog" aria-labelledby="modal-login-label" aria-hidden="true" data-backdrop="static"> 
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-login-label">Login da Empresa</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" action="">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" id="type" name="type" value="empresa">
                        <div class="form-group">
                            <div class="label-float">
                                <input class="col-12" id="cnpj" type="text" name="cnpj" placeholder=" " autofocus/>
                                <label class="label">CNPJ</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="label-float">
                                <input class="col-12 @error('password') is-invalid @enderror senha"  name="password" type="password" placeholder=" " />
                                <label class="label">Senha</label>
                            </div>
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group" style="margin:0">
                            <div class="col-12" style="padding:0">
                                <label class="label-checkbox">
                                    <input type="checkbox" class="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                        Lembre-se de mim
                                </label>
                            </div>
                        </div>

                        @if (Route::has('empresa.password.request'))
                            <a class="btn btn-link" style="padding-left: 2px" href="{{ route('empresa.password.request') }}">
                                {{ __('Esqueceu sua senha?') }}
                            </a>
                        @endif
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-dg" data-dismiss="modal">Fechar</button>
                        <button type="submit "class="btn btn-sc">Logar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modal-login-representante" tabindex="-1" role="dialog" aria-labelledby="modal-login-label" aria-hidden="true" data-backdrop="static"> 
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-login-label">Login do Representante</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" action="{{ route('representante.login.submit') }}">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" id="type" name="type" value="representante">
                        <div class="form-group">
                            <div class="label-float">
                                <input class="col-12" id="cpf" name="cpf" type="text" placeholder=" " autofocus/>
                                <label class="label">CPF</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="label-float">
                                <input class="col-12 @error('password') is-invalid @enderror senha"  name="password" type="password" placeholder=" " />
                                <label class="label">Senha</label>
                            </div>
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group" style="margin:0">
                            <div class="col-12" style="padding:0">
                                <label class="label-checkbox">
                                    <input type="checkbox" class="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                        Lembre-se de mim
                                </label>
                            </div>
                        </div>

                        @if (Route::has('representante.password.request'))
                            <a class="btn btn-link" style="padding-left: 2px" href="{{ route('representante.password.request') }}">
                                {{ __('Esqueceu sua senha?') }}
                            </a>
                        @endif
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-dg" data-dismiss="modal">Fechar</button>
                        <button type="submit "class="btn btn-sc">Logar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modal-login-comerciante" tabindex="-1" role="dialog" aria-labelledby="modal-login-label" aria-hidden="true" data-backdrop="static"> 
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-login-label">Login do Comerciante</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" action="{{ route('comerciante.login.submit') }}">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" id="type" name="type" value="comerciante"> 
                        <div class="form-group">
                            <div class="label-float">
                                <input class="col-12" id="cnpjC" type="text" name="cnpj" placeholder=" " autofocus/>
                                <label class="label">CNPJ</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="label-float">
                                <input class="col-12 @error('password') is-invalid @enderror senha"  name="password" type="password" placeholder=" " />
                                <label class="label">Senha</label>
                            </div>
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group" style="margin:0">
                            <div class="col-12" style="padding:0">
                                <label class="label-checkbox">
                                    <input type="checkbox" class="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                        Lembre-se de mim
                                </label>
                            </div>
                        </div>

                        @if (Route::has('comerciante.password.request'))
                            <a class="btn btn-link" style="padding-left: 2px" href="{{ route('comerciante.password.request') }}">
                                {{ __('Esqueceu sua senha?') }}
                            </a>
                        @endif
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-dg" data-dismiss="modal">Fechar</button>
                        <button type="submit "class="btn btn-sc">Logar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modal-selected" tabindex="-1" role="dialog" aria-labelledby="modal-selected-label" aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog modal-dialog-centered" role="document" style="width: 400px">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title pl-2" id="modal-login-label">Selecione o Usuário</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
            <span aria-hidden="true">&times;</span>
            </button>
                </div>
                <div class="modal-body user">
                    <div class="col" data-toggle="modal" data-target="#modal-login-representante" data-name='representante'>
                        <i class="fas fa-user-circle mr-3"></i> Representante/Vendedor
                    </div>
                    <div class="col" data-toggle="modal" data-target="#modal-login-comerciante" data-name='comerciante' >
                        <i class="far fa-user-circle mr-3"></i> Comerciante/Lojista
                    </div>
                    <div class="col pb-4" data-toggle="modal" data-target="#modal-login-empresa" data-name='empresa'>
                        <i class="far fa-building mr-3"></i> Empresa
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modal-register" tabindex="-1" role="dialog" aria-labelledby="modal-register-label" aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog modal-dialog-centered" role="document" style="width: 400px">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title pl-2" id="modal-login-label">Selecione seu usuário</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
            <span aria-hidden="true">&times;</span>
            </button>
                </div>
                <div class="modal-body user">
                    <a href="{{ route('representante.create') }}">
                        <div class="col" data-name='representante'>
                            <i class="fas fa-user-circle mr-3"></i> Representante/Vendedor
                        </div>
                    </a>
                    <a href="{{ route('comerciante.create') }}">
                        <div class="col" data-name='comerciante'>
                            <i class="far fa-user-circle mr-3"></i> Comerciante/Lojista
                        </div>
                    </a>
                    <a href="">
                        <div class="col pb-4" data-name='empresa'>
                            <i class="far fa-building mr-3"></i> Empresa
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
      
    </body>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="{{ asset('js/app.js') }}"  media="screen,projection"></script>
    @yield('javascript')
    
</html>
