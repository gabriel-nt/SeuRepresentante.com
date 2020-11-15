@extends('layouts.dashboard')

@section('title')
    <title>Carrinho</title>
@endsection

@include('comerciante.side-menu')

@section('content')
<div class="row">
    <div class="col mb-3 tx-c">
        <h2 style="font-family: Open Sans; font-size: 2.5em">Carrinho</h2>
    </div>
</div>
<div class="row mb-3">
    <div class="col-md-6 col-sm-10">
        @include('partials.alerts')
    </div>
</div>
@if (Cart::count() > 0) 
<div class="row">
    <div class="col-sm-12 col-md-8">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="row">
                    <h3 class="col panel-title pt-2 pl-3">{{ Cart::count() }} Item(s) no Carrinho</h3>
                    <div class="col tx-r">
                        <a class="btn btn-dg btn-rounded mr-1" href="{{route('cart.destroy')}}">
                            <i class="far fa-trash-alt"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-hover table-striped table-borderless table-valign-middle tb" style="margin-bottom: 0" id="dev-table">
                    <thead class="tx-c">
                        <tr>
                            <th>Imagem</th>
                            <th>Nome</th>
                            <th>Preço</th>
                            <th>Quantidade</th>
                            <th>Remover</th>
                        </tr>
                    </thead>
                    <tbody class="tx-c">
                        @foreach (Cart::content() as $item)
                        <tr>
                            <td>
                                <span class="img-profile" style="width: 60px; height: 60px; background-image: url( {{ asset($item->model->imagem)}})"></span>
                            </td>
                            <td><a class="link" href="{{ route('produto.show', ['id' => $item->model->id ])}}">{{$item->model->nome}}</a></td>
                            <td>R$ {{$item->model->valor}}</td>
                            <td>
                                <input type="number" class="number-style qty" value="{{ $item->qty }}" step="1" min="1" max="10" disabled data-id="{{$item->rowId}}">
                            </td>
                            <td>
                                <form action="{{ route('cart.remove', $item->rowId) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
    
                                    <button type="submit" class="icon-delete">
                                        <i class="far fa-lg  fa-times-circle text-red"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="col-sm-12 col-md-4">
        <div class="mt-6">
            <div class="cartbox d-flex justify-content-between">
                <ul>
                    <li class="cart-title">SubTotal</li>
                    <li class="cart-title">Frete</li>
                </ul>
                <ul>
                    <li class="cart-total">R${{Cart::subtotal()}}</li>
                    <li class="cart-total">R${{Cart::tax()}}</li>
                </ul>
            </div>
            <div class="cart-amount">
                <span>Total</span>
                <span>R${{Cart::total()}}</span>
            </div>
            <div class="row m-0 pt-3 pl-2 cart-value">
                <div class="col-xs-3">
                    <i class="fa fa-credit-card p-2" style="font-size: 30px"></i>
                </div>
                <div class="col-xs-9 pl-2">
                    <span>3</span> boletos de <span>
                    R${{Cart::parcela()}}</span> 
                    <br>sem juros 
                </div>
            </div>
            <div class="row m-0 pt-3 pb-3 pl-2 cart-value">
                <div class="col-xs-3">
                    <i class="fa fa-barcode p-2" style="font-size: 30px"></i>
                </div>
                <div class="col-xs-9 pl-2">
                <span style="color:green; font-weight: bold">R${{Cart::descont()}} <small>(desconto de 5%)</small></span> 
                    <br>com desconto em 1x no boleto
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row mt-1">
    <div class="col tx-l">
        <a href="{{route('comerciante.products')}}"class="btn btn-if ">Continue comprando</a>
    </div>
    <div class="col tx-r">
        <form action="{{ route('pedido.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
            <input type="hidden" name="comercianteId" value="{{Auth::user()->id}}">
            <input type="hidden" name="discount" value="{{Cart::descont()}}"> 
            <input type="hidden" name="total" value="{{Cart::total()}}">
            <button type="submit" class="btn btn-sc">Finalizar Pedido</button>
        </form>
    </div>
</div>
@else
<div class="row">
    <div class="head-cart" style="font-family: Open Sans">
        <h2>CARRINHO VAZIO</h2>
    </div>
    <div class="col-12 bg-white tx-c">
        <img src="{{asset('img/cart.png')}}" width="220" alt="Imagem Carrinho">
        <h2 class="tx-c">Não há produtos selecionados até o momento!</h2>
        <p class="tx-c">Seu carrinho está vazio. Voltar para o site.</p>
    </div>
</div>
@endif
@endsection

@section('javascript')
<script>
    $('.number-style').each(function() {
        $(this).number();
    });

    (function(){
        const classPlus = $('.number-plus');
        Array.from(classPlus).forEach(function(element) {
            element.addEventListener('click', function(e) {
                e.preventDefault();
                let container = $(element).parent();
                let input = container.find('.qty');
                const id = input.attr('data-id');
                axios.post(`/cart/atualizar/${id}`, {
                    quantity: input.val(),
                })
                .then(function (response) {
                    window.location.href = '{{ route('cart.index') }}'
                })
                .catch(function (error) {
                    window.location.href = '{{ route('cart.index') }}'
                });
            })
        });

        const classMinus = $('.number-minus');
        Array.from(classMinus).forEach(function(element) {
            element.addEventListener('click', function(e) {
                e.preventDefault();
                let container = $(element).parent();
                let input = container.find('.qty');
                const id = input.attr('data-id');
                axios.post(`/cart/atualizar/${id}`, {
                    quantity: input.val(),
                })
                .then(function (response) {
                    window.location.href = '{{ route('cart.index') }}'
                })
                .catch(function (error) {
                    window.location.href = '{{ route('cart.index') }}'
                });
            })
        });    
    })();

    $('.alerts-session-close').click(function(e){
        e.preventDefault();
        var parent = $(this).parent('.alerts-session');
        parent.fadeOut("slow", function() { 
            $(this).remove(); 
        });
    });
</script>
@endsection