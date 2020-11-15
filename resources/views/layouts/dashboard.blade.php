<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    @yield('title')
  
    <link rel="shortcut icon" type="imagem/x-icon" href="{{asset('img/favicon.ico')}}" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.2/css/all.css" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="{{ asset('css/adminlte.css') }}"  media="screen,projection"/>
    <link type="text/css" rel="stylesheet" href="{{ asset('css/style.css') }}"  media="screen,projection"/>
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    
    @yield('css')
</head>

<body class="sidebar-mini hold-transition">
    <div class="wrapper">

        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
                </li>
            </ul>

            <ul class="navbar-nav ml-auto"> 
                @if(Auth::user()->typeUser == 'comerciante')
                <li class="nav-item mt-2">
                    <a class="nav-link" href="{{route('cart.index')}}">
                        <i class="fas fa-lg fa-shopping-cart"></i>
                        <span class="badge badge-warning navbar-badge">{{ Cart::count() }}</span>
                    </a>      
                </li>
                @endif
                <li class="nav-item dropdown user-menu">
                    <a href="#" class="nav-link dropdown-toggle btn-img" data-toggle="dropdown">
                        <div class="img-ct">
                            @if( Auth::user()->imagem == null)
                            <span class="img-profile" style="width: 34px; height: 34px; background-image: url({{ asset('img/sem-foto-perfil.jpg') }})"></span>
                            @else
                            <span class="img-profile" style="width: 34px; height: 34px; background-image: url( {{ asset(Auth::user()->imagem)}})"></span>
                            @endif
                        </div>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <!-- User image -->
                        <li class="user-header bg-gradient-gray-dark">

                            @if( Auth::user()->imagem == null)
                            <span class="img-profile elevation-2" style="width: 90px; height: 90px; border: 3px solid white; background-image: url( {{ asset('img/sem-foto-perfil.jpg')}})"></span>
                            @else
                            <span class="img-profile elevation-2" style="width: 90px; height: 90px; border: 3px solid white; background-image: url( {{ asset(Auth::user()->imagem)}})"></span>
                            @endif

                            <p class="text-white">
                                @if(Auth::user()->typeUser == 'comerciante')
                                {{ Auth::user()->razaoSocial }}
                                @else
                                {{ Auth::user()->nome }}
                                @endif
                                <small>Usuário desde {{ date( 'd/m/Y' , strtotime(Auth::user()->created_at))}}</small>
                            </p>

                        </li>
                        <li class="user-body">
                            <div class="row">
                                <div class="col-6 text-center">
                                    <a href="{{ route(Auth::user()->typeUser.'.edit', ['id' => Auth::user()->id ])}}">Editar Perfil</a>
                                </div>
                                <div class="col-6 text-center">
                                    <a href="{{ route(Auth::user()->typeUser.'.show', ['id' => Auth::user()->id ])}}">Ver perfil</a>
                                </div>
                            </div>
                        </li>

                        <li class="user-footer">
                            <a class="btn btn-primary float-right" href="{{ route('logout') }}"
                            onclick="event.preventDefault();document.getElementById('logout-form').submit();">Sair</a>

                            <form id="logout-form" action="{{ url('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>

        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <a class="brand-link">
                <img src="{{ asset('img/logoTCC.png') }}" class="img-fluid" style="width:200px; margin-left: 10px;"/>
            </a>

            <div class="sidebar">
                <nav class="mt-2">
                    @yield('side-menu')
                </nav>
            </div>
        </aside>

        <div class="content-wrapper bg-white">
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-12">
                            @yield('content')
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <aside class="control-sidebar control-sidebar-dark">
        </aside>

        @yield('float-button')
        
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="{{ asset('js/app.js') }}"  media="screen,projection"></script>
    <script src="{{ asset('js/adminlte.js') }}"  media="screen,projection"></script>
    @yield('javascript')

</body>

</html>