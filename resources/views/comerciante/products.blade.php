@extends('layouts.dashboard')

@section('title')
    <title>Produtos</title>
@endsection

@include('comerciante.side-menu')

@section('content')

@if(count($produtos) > 0)
@foreach ($representantes as $representante)
    <div class="row mb-1">
        <hr class="hr">
         @if($representante->imagem)
         <span class="img-profile header-img" style="width: 60px; height: 60px; background-image: url( {{ asset($representante->imagem)}})"></span>
        @else
        <span class="img-profile header-img" style="width: 60px; height: 60px; background-image: url( {{ asset('img/sem-foto-perfil.jpg')}})"></span>
        @endif
        
        @foreach ($produtos as $produto)
            @if ($produto->representante_id == $representante->id)
                <div class="col-xs-12 col-sm-6 col-md-3 pt-4">
                    <div class="product-container">
                        <div class="items tx-c">
                            <a class="items">
                            <img src="{{ asset($produto->imagem)}}" class="img-fluid">
                            </a>
                        </div>
                        <div class="caption">
                            <a class="caption-name" href="{{ route('produto.show', ['id' => $produto->id ])}}">
                            <h2><strong>{{$produto->nome}} da marca {{$produto->marca}}</strong></h2></a>
                        </div>
                        <div class="commerce_columns_item_info">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="price"><span>R$ {{$produto->valor}}</span> no boleto</div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                    
                                <div class="btn-group btn-gp" role="group" aria-label="Comprar">
                                    <a href="{{ route('produto.show', ['id' => $produto->id ])}}" class="buttons btn buy">Comprar</a>
                                    <form method="POST" action="#" enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" class="id" value="{{$produto->id}}">
                                        <input type="hidden" class="name" value="{{$produto->nome}}">
                                        <input type="hidden" class="price-item" value="{{$produto->price}}">
                                    </form>    
                                    <button type="submit" class="buttons btn cart addCart"><span class="fas text-black fa-shopping-cart"></span></button> 
                                </div>     
                            </div>  
                        </div>
                    </div>
                </div>
            @endif
        @endforeach
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

    <h1 class="result-none">Oops! Nenhum produto cadastrado!</h1>
@endif

@endsection

@section('javascript')
<script>
    $('.number-style').each(function() {
        $(this).number();
    });

    (function(){
        const addCart = $('.addCart');
        Array.from(addCart).forEach(function(element) {
            element.addEventListener('click', function() {
                let container = $(element).parent();
                let form = container.find('form');
                const id = form.find('.id').val();
                const name = form.find('.name').val();
                const price = form.find('.price-item').val();
                axios.post(`/cart/add-item`, {
                    id: id,
                    name: name,
                    price: price,
                })
                .then(function (response) {
                    window.location.href = '{{ route('comerciante.products') }}'
                })
                .catch(function (error) {
                    window.location.href = '{{ route('comerciante.products') }}'
                });
            })
        }); 
    })();
</script>
@endsection