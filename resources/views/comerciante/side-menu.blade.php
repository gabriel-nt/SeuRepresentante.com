@section('side-menu')
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item has-treeview menu-open">
            <a href={{route('comerciante.dashboard')}} class="nav-link">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                    Dashboard
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('comerciante.listRepresentantes')}}" class="nav-link">
                <i class="nav-icon fas fa-lg fa-user-circle"></i>
                <p>
                    Representantes
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('comerciante.products')}}" class="nav-link">
                <i class="nav-icon fas fa-lg fa-cart-arrow-down"></i>
                <p>
                    Produtos
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('comerciante.showPedidos')}}" class="nav-link">
                <i class="nav-icon far fa-lg fa-clipboard"></i>
                <p>
                    Meus Pedidos
                </p>
            </a>
        </li>
    </ul>
@endsection