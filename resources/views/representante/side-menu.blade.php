@section('side-menu')
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item has-treeview menu-open">
            <a href={{route('representante.dashboard')}} class="nav-link">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                    Dashboard
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('produto.index')}}" class="nav-link">
                <i class="nav-icon fas fa-lg fa-cart-arrow-down"></i>
                <p>
                    Meus Produtos
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{route('representante.showLocation', ['id' =>Auth::user()->localizacao])}}" class="nav-link">
                <i class="nav-icon fas fa-lg fa-location-arrow"></i>
                <p>
                    Minha Localização
                </p>
            </a>
        </li>
        <li class="nav-item">
            @if (Auth::user()->localizacao)
            <a href="{{route('representante.editLocation', ['id' =>Auth::user()->localizacao])}}" class="nav-link">
                <i class="nav-icon fas fa-map-marker-alt"></i>
                <p>
                    Localização
                </p>
            </a>
            @else 
            <a href="{{route('representante.location')}}" class="nav-link">
                <i class="nav-icon fas fa-map-marker-alt"></i>
                <p>
                    Localização
                </p>
            </a>
            @endif
        </li>
        <li class="nav-item">
            <a href="{{ route('representante.showPedidos')}}" class="nav-link">
                <i class="nav-icon far fa-lg fa-clipboard"></i>
                <p>
                    Pedidos
                </p>
            </a>
        </li>
    </ul>
@endsection