@extends('layouts.dashboard')

@section('title')
    <title>Atualização de Produto</title>
@endsection

@include('representante.side-menu')

@section('content')
    <div class="container">
        <div class="col-12 mb-2">
            <center>
                <div class="about">
                    <i class="fas fa-shopping-cart icone"></i>
                    <h2 style="font-family: League Gothic">Produto</h2>
                    <p>Atualizar produto</p>
                </div>
            </center>
                <form action="{{ route('produto.update', ['id' => $produto->id]) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-row">
                        <div class="form-group col-sm-12 col-md-7">
                            <div class="input-container is-valid @error('nome') is-invalid @enderror">
                                <input id="nome" name='nome' class="input" value="{{old('produto', $produto->nome)}}" type="text" />
                                <label class="label" for="nome">Nome do Produto</label>
                                @error('nome')
                                <span class="validation">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>               
                        </div>
                        <div class="form-group col-sm-12 col-md-5">
                            <div class="input-container is-valid @error('Marca') is-invalid @enderror">
                                <input id="marca" name='marca' class="input" value="{{old('produto', $produto->marca)}}"type=""/>
                                <label class="label" for="marca">Marca</label>
                                @error('Marca')
                                <span class="validation">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-sm-12 col-md-12">
                            <div class="input-container is-valid @error('descricao') is-invalid @enderror">
                                <textarea id="descricao" rows="6" name='descricao' class="input">{{old('produto', $produto->descricao)}}</textarea>
                                <label class="label" for="descricao">Descrição</label>
                                @error('descricao')
                                <span class="validation">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-sm-12 col-md-4">
                            <div class="input-container is-valid @error('valor') is-invalid @enderror">
                                <input id="valor" class="input" name='valor' value="{{old('produto', $produto->valor)}}"type="text" />
                                <label class="label" for="valor">Valor em R$</label>
                                @error('valor')
                                <span class="validation">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group col-sm-12 col-md-4">
                            <div class="input-container is-valid @error('unidadeVenda') is-invalid @enderror">
                                <input id="unidadeVenda" class="input" type="unidadeVenda" name="unidadeVenda" value="{{old('produto', $produto->unidadeVenda)}}"/>
                                <label class="label" for="unidadeVenda">Unidade de Medida</label>
                                @error('unidadeVenda')
                                <span class="validation">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group col-sm-12 col-md-4">
                            <label class="range-label">Estoque</label>
                            <div class="range-slider">
                            <input type="range" min="1" max="100" value="{{$produto->estoque}}" name="estoque" class="slider" id="range">
                                <span class="range-slider__value">{{$produto->estoque}}</span>
                            </div>
                        </div>
                    </div>

                    <div class="form-row">
                        @if($produto->imagem)
                        <div class="col-sm-12 col-md-6 profile-edit">
                            <p>O produto já posssui uma imagem. Mude ao lado, se quiser</p>
                            <img src="{{ asset($produto->imagem)}}" class="img-fluid" style="max-height:200px">
                        </div>
                        @else
                        <div class="col-sm-12 col-md-6 profile-edit">
                            <p>O produto não possui uma imagem. Abaixo, a sua foto temporária do produto.</p>
                            <img src="{{ asset('img/sem-foto-perfil.jpg')}}" class="img-fluid img-thumbnail" style="width:200px;">
                        </div> 
                        @endif
                        <div class="form-group col-sm-12 col-md-6 product">
                        </div>
                    </div>

                    <div>
                        <button type="submit" class="btn btn-sc btn-md mr-1">Atualizar</button>
                        <a href="{{route('produto.index')}}" class="btn btn-md btn-dg">Cancelar</a>
                    </div>   
                </form>
        </div>
    </div>

    <div class="modal fade" id="modal-crop" tabindex="-1" role="dialog" aria-labelledby="modal-register-label" aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog modal-dialog-centered" role="document" style="width: 600px">
            <div class="modal-content">
                <div class="modal-body">
                    
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-danger cancel">Cancelar</button>
                    <button type="button" class="btn btn-success crop">Cortar</button>
                </div>
            </div>
            
        </div>
    </div>
@endsection

@section('javascript')
    <script>
        let inputImage = new InputImage({
            namePath: 'image',
        });
        inputImage.init();
        $('.product').append(inputImage.getView());
    </script>
@endsection
