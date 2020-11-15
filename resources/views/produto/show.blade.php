@extends('layouts.dashboard')

@section('title')
    <title>Produto</title>
@endsection

@if (Auth::user()->typeUser == 'comerciante')
    @include('comerciante.side-menu')
@else
    @include('representante.side-menu')
@endif

@section('content')
<div class="card-product">
    <nav>
        <div class="row">
            <div class="col">
                <i class="far fa-arrow-alt-circle-left arrow"></i>
            </div>
            <div class="col" style="text-align: center">
                <span>Compre o seu</span>
            </div>
            <div class="col" style="text-align: right;">
                <i class="far fa-heart heart"></i>
            </div>    
        </div>
    </nav>
    
    <div class="row" style="margin-left: 0">
        <div class="photo-ct col-4">
            <div class="photo">
                <img src="{{ asset($produto->imagem)}}" class="img-fluid">
            </div>
        </div>
        <div class="col-8 description-ct">
            <div class="description">
                <h2>{{$produto->nome}}</h2>
                <h4>{{$produto->marca}}</h4>
                <p class="product-rating">
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star grey"></i>
                </p>
                <span class="product-price">
                    <b>R${{$produto->valor}}</b>
                </span>
                <p class="estoque pt-1 pb-1">
                    <small><b>Restam apenas {{$produto->estoque}} produtos à venda</b></small>
                </p>
                <p style="font-size: 15px">{{$produto->descricao}}</p>
                <div class="row pl-3">
                    <form method="POST" action="{{ route('cart.store') }}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" value="{{$produto->id}}">
                        <input type="hidden" name="name" value="{{$produto->nome}}">
                        <input type="hidden" name="price" value="{{$produto->price}}">
                        <button type="submit">
                            Comprar 
                            <i class="fas fa-lg fa-shopping-cart pl-1"></i>
                        </button>
                    </form>
                    <button>
                        Frete 
                        <i class="fas fa-lg fa-truck-moving pl-1"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
