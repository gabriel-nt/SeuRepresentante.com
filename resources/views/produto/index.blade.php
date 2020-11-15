@extends('layouts.dashboard')

@section('title')
    <title>Meus Produtos</title>
@endsection

@include('representante.side-menu')

@section('content')
    @include('partials.alerts')
    <div class="panel panel-primary">
        <div class="panel-heading">
            <div class="row">
                <h3 class="col panel-title">Produtos</h3>
                <div class="col ft-ct">
                    <span class="filter" data-toggle="tooltip" title="Abrir ou esconder o campo de pesquisa" data-container="body">
                        <i class="fas fa-filter"></i>
                    </span>
                </div>
            </div>
        </div>
        <div class="panel-body">
            <div class="input-container">
                <input id="search" name='search' class="input" type="text" />
                <label class="label" for="search">Pesquise por produtos</label>
            </div> 
        </div>
        <div class="table-responsive">
            <table class="table table-hover table-striped table-borderless table-valign-middle tb" style="margin-bottom: 0" id="dev-table">
                <thead class="tx-c">
                    <tr>
                        <th>Nome</th>
                        <th>Preço</th>
                        <th>Imagem</th>
                        <th>Opções</th>
                    </tr>
                </thead>
                <tbody class="tx-c">
                    @foreach ($produtos as $produto)
                    <tr>
                        <td>{{$produto->nome}}</td>
                        <td>R$ {{$produto->valor}}</td>
                        <td>
                            <span class="img-profile" style="width: 60px; height: 60px; background-image: url( {{ asset($produto->imagem)}})"></span>
                        </td>
                        <td>
                            <a href="{{ route('produto.show', ['id' => $produto->id ])}}" class="btn btn-rounded waves-effect btn-if">Visualizar</a>        
                            <a href="{{ route('produto.edit', ['id' => $produto->id ])}}" class="btn btn-rounded waves-effect btn-wg">Editar</a>
                            <a href="#" class="btn btn-rounded waves-effect btn-dg">Desativar</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('float-button')
    <div class="btn-ft-ct">
        <button type="button" class="btn btn-ft-mn btn-if">
            <i class="ic ft-plus far fa-edit"></i>
            <i class="ic ft-edit far fa-edit"></i>
        </button>
        <a href="{{ route('produto.create')}}" class="btn btn-ft btn-sc">
            <i class="ic fas fa-plus"></i>
        </a>
    </div>
@endsection

@section('javascript')
    <script>
        $(document).ready(function() {
            $('[data-toggle="tooltip"]').tooltip();
            $('.filter').on('click', function(e){
                let $this = $(this);
                let $panel = $this.parents('.panel');  
                $panel.find('.panel-body').slideToggle();
            });
        });

        $('.alerts-session-close').click(function(e){
            e.preventDefault();
            var parent = $(this).parent('.alerts-session');
            parent.fadeOut("slow", function() { 
                $(this).remove(); 
            });
        });
    </script>
@endsection