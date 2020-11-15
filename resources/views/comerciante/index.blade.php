@extends('layouts.dashboard')

@section('title')
    <title>Dashboard</title>
@endsection

@include('comerciante.side-menu')

@section('content')
<div class="container">
    <div class="row mb-3">
        <div class="col-md-6 col-sm-10">
            @include('partials.alerts')
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-lg-3 col-6">
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{$representantes}}</h3>

                    <p>Representantes Cadastrados</p>
                </div>
                <div class="icon">
                    <i class="ion ion-ios-person"></i>
                </div>
                <a href="{{route('comerciante.listRepresentantes')}}" class="small-box-footer">Saiba Mais         <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>{{$pedidos}}</h3>

                    <p>Pedidos realizados</p>
                </div>
                <div class="icon">
                    <i class="ion ion-bag"></i>
                </div>
            <a href="{{route('comerciante.showPedidos')}}" class="small-box-footer">Saiba Mais         <i class="fas fa-arrow-circle-right"></i></a>
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