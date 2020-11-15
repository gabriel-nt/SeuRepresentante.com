@extends('layouts.dashboard')

@section('title')
    <title>Pedidos</title>
@endsection

@include('representante.side-menu')

@section('content')
    <div class="mb-3 mt-2 title-request">Pedidos de Clientes</div>
    @if(count($pedidos) > 0)
    @foreach ($pedidos as $pedido)
    <div id="accordion-{{$pedido->id}}">
        <div class="card">
            <div class="card-header" data-toggle="collapse" data-target="#collapse-{{$pedido->id}}" aria-expanded="true" aria-controls="collapse-{{$pedido->id}}" id="heading-{{$pedido->id}}">
                <div class="row">
                    <div class="col-6">
                        PEDIDO: <span class="cl-pr">#{{$pedido->id}}</span>
                    </div>
                    <div class="col-6 tx-r">
                        <span class="cl-blue">VER RESUMO</span>
                    </div>
                </div> 
            </h5>
        </div>
    
        <div id="collapse-{{$pedido->id}}" class="collapse" aria-labelledby="heading-{{$pedido->id}}" data-parent="#accordion-{{$pedido->id}}">
            <div class="card-body pb-1">
                <div class="row">
                    <div class="col-xs-6 col-md-3"><span>Data e Hora</span>
                        <p>{{date( 'd/m/Y H:i:s' , strtotime($pedido->created_at))}}</p>
                    </div>
                    <div class="col-xs-6 col-md-3"><span>Valor Total</span>
                        <p>R$ {{$pedido->valorTotal}}</p>
                    </div>
                    <div class="col-xs-6 col-md-3"><span>Vendedor</span>
                        <p>{{$pedido->nome}}</p>
                    </div>
                    <div class="col-xs-6 col-md-3"><span>Comprador</span>
                        <p>{{$pedido->razaoSocial}}</p>
                    </div>
                    <div class="col-xs-12 col-md-12 more-info"></div>
                </div>
            </div>
            <div class="card-footer text-muted">
            <a href="{{route('pedido.show', [$pedido->id])}}" style="text-decoration:none">Mais detalhes desse pedido <i class="fa fa-share" aria-hidden="true"></i></a>
            </div>
        </div>
    </div>
    @endforeach
    @else 
    <div class="face">
        <div class="band">
            <div class="red"></div>
            <div class="white"></div>
            <div class="blue"></div>
        </div>
        <div class="eyes"></div>
        <div class="dimples"></div>
        <div class="mouth"></div>
    </div>
    
    <h1 class="result-none">Oops! Nenhum pedido encontrado!</h1>
    @endif
    </div>
@endsection

