@extends('layouts.dashboard')

@section('title')
    <title>Dashboard</title>
@endsection

@include('representante.side-menu')

@section('content')
<div class="container">
    <div class="row mb-3">
        <div class="col-md-6 col-sm-10">
            @include('partials.alerts')
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-4 col-sm-12">
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{$comerciantes}}</h3>

                    <p>Comerciantes Cadastrados</p>
                </div>
                <div class="icon">
                    <i class="ion ion-stats-bars"></i>
                </div>
                <a href="#" class="small-box-footer">Saiba Mais    <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-md-4 col-sm-12">
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>{{$produtos}}</h3>

                    <p>Produtos cadastrados</p>
                </div>
                <div class="icon">
                    <i class="ion ion-bag"></i>
                </div>
            <a href="{{route('produto.index')}}" class="small-box-footer">Saiba Mais    <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-md-4 col-sm-12">
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>{{$pedidos}}</h3>

                    <p>Pedidos realizados</p>
                </div>
                <div class="icon">
                    <i class="ion ion-stats-bars"></i>
                </div>
            <a href="{{route('representante.showPedidos')}}" class="small-box-footer">Saiba Mais    <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-md-4 col-sm-12">
            <div class="small-box bg-info">
                @if (count($endereco) > 0)
                <div class="inner">
                    <h3>Endereço</h3>
                    
                    @foreach ($endereco as $item)
                        <p>Atualizado em: {{date( 'd/m/Y H:i:s' , strtotime($item->updated_at))}}</p>
                    @endforeach
                </div>
                <div class="icon">
                    <i class="ion ion-stats-bars"></i>
                </div>
                <a href="{{route('representante.showPedidos')}}" class="small-box-footer">Saiba Mais     <i class="fas fa-arrow-circle-right"></i></a>
                @else 
                <div class="inner">
                    <h3>Endereço</h3>

                    <p>Nenhum endereço cadastrado</p>
                </div>
                <div class="icon">
                    <i class="ion ion-stats-bars"></i>
                </div>
                <a href="{{route('representante.location')}}" class="small-box-footer">Cadastrar   <i class="fas fa-arrow-circle-right"></i></a>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

@section('javascript')
<script>
    $('.alerts-session-close').click(function(e){
        e.preventDefault();
        var parent = $(this).parent('.alerts-session');
        parent.fadeOut("slow", function() { 
            $(this).remove(); 
        });
    });
</script>
@endsection