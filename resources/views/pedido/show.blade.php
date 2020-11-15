@extends('layouts.dashboard')

@section('title')
    <title>Dados do Pedido</title>
@endsection

@if (Auth::user()->typeUser == 'comerciante')
    @include('comerciante.side-menu')
@else
    @include('representante.side-menu')
@endif

@section('content')

    @foreach ($pedido as $data)
    <div class="row">
        <div class="col-md-12 mb-2">
            <center>
                <div class="about">
                    <i class="fas fa-plus icone" style="font-size: 50px"></i>
                    <h2 style="font-family: League Gothic">Detalhes do Pedido</h2> 
                </div>
            </center>
        </div>
        <div class="col-md-6 mt-2">
            <h3 class="title-request">- Dados do cliente</h3>
            <table class="table table-striped table-borderless">
                <tbody>
                    <tr>
                        <td>Tipo:</td>
                        <td>Pessoa Jurídica</td>
                    </tr>
                    <tr>
                        <td>Razão Social:</td>
                        <td>{{$data->razaoSocial}}</td>
                    </tr>
                    <tr>
                        <td>CNPJ:</td>
                        <td>{{$data->CNPJ}}</td> 
                    </tr>
                    <tr>
                        <td>E-mail:</td>
                        <td>{{$data->emailComerciante}}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    
        <div class="col-md-6 mt-2">
            <h3 class="title-request">- Dados do vendedor</h3>
            <table class="table table-striped table-borderless">
                <tbody>
                    <tr>
                        <td>Tipo:</td>
                        <td>Pessoa Física</td>
                    </tr>
                    <tr>
                        <td>Nome:</td>
                        <td>{{$data->nome}}</td>
                    </tr>
                    <tr>
                        <td>CPF:</td>
                        <td>{{$data->CPF}}</td>
                    </tr>
                    <tr>
                        <td>E-mail:</td>
                        <td>{{$data->emailRepresentante}}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    
        <div class="col-md-6 mt-2">
            <h3 class="title-request">- Dados do Pedido</h3>
            <table class="table table-striped table-borderless">
                <tbody>
                    <tr>
                        <td>Número do Pedido</td>
                        <td>{{$data->id}}</td>
                    </tr>
                    <tr>
                        <td>Data e Hora</td>
                        <td>{{date( 'd/m/Y H:i:s' , strtotime($data->created_at))}}</td>
                    </tr>
                    <tr>
                        <td>Quantidade de produtos:</td>
                        <td>{{$data->quantidade}}</td>
                    </tr>
                    <tr>
                        <td>Valor C/Desc:</td>
                        <td>R$ {{$data->subTotal}}</td>     
                    </tr>
                    <tr>
                        <td>Valor Total:</td>
                        <td>R$ {{$data->valorTotal}}</td>
                    </tr>
                    <tr>
                        <td>Ver PDF:</td>
                        <td><a href="{{route('pedido.pdf', [$data->id])}}" target="_blank">Abrir PDF</a></td>
                    </tr>
                    <tr>
                        <td>Download PDF:</td>
                        <td><a href="{{route('pedido.downloadPDF', [$data->id])}}">Baixar PDF</a></td>
                    </tr>
                </tbody>
            </table>
        </div>
    
        <div class="col-md-12 mt-2">
            <h3 class="title-request">- Dados dos produtos</h3>
            <table class="table table-striped table-borderless">
                <thead class="thead-dark">
                    <tr>
                        <th>Descrição do produto</th>
                        <th>Quantidade</th>
                        <th>R$ Unit.</th>
                        <th>R$ Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($produtos as $produto)
                    <tr>
                        <td class="tx-l">
                            <img src="{{asset($produto->imagem)}}" style="float:left;width: 80px;padding-right: 10px;"> {{$produto->nome}}
                        </td>
                        <td>{{$produto->quantidade}}</td>
                        <td>R$ {{$produto->valor}}</td>
                        <td class="value-total">R$ {{$produto->price*$produto->quantidade}}</td>
                    </tr>
                    @endforeach
                    <tr>
                        <td colspan="2"></td>
                        <td>SUBTOTAL</td>
                        <td>R$ {{$data->subTotal}}</td>
                    </tr>
                    <tr>
                        <td colspan="2"></td>
                        <td>QUANTIDADE</td>
                        <td>{{$data->quantidade}}</td>
                    </tr>
                    <tr>
                        <td colspan="2"></td>
                        <td>TOTAL</td>
                        <td>R$ {{$data->valorTotal}}</td>
                    </tr>           
                </tbody>
            </table>
        </div>
    </div>
    @endforeach
    
@endsection