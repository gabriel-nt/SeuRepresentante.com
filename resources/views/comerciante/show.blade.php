@extends('layouts.dashboard')

@section('css')
    <style>
        .profile-header {
        transform: translateY(5rem);
    }
    </style>
@endsection

@section('title')
    <title>Meu Perfil</title>
@endsection

@include('comerciante.side-menu')

@section('content')
            
            <div class="row py-5 px-4">
                <div class="col-lg-6 col-md-8 col-sm-10 mx-auto">  
                    <!-- Profile widget -->
                    <div class="bg-white shadow rounded overflow-hidden">
                        <div class="px-4 pt-0 pb-4 bg-dark" style="background-image: url({{ asset('img/thumbnail.jpg') }})">
                            <div class="media align-items-end profile-header">
                                <div class="profile mr-3">
                                @if($comerciante->imagem)
                                <img src="{{ asset($comerciante->imagem) }}" style="width:170px" class="rounded mb-2 img-thumbnail">
                                @else
                                <img src="{{ asset('img/sem-foto-perfil.jpg') }}" style="width:170px" class="rounded mb-2 img-thumbnail">
                                @endif
                                <a href="{{ route('comerciante.edit', ['id'=> $comerciante->id]) }}" class="btn btn-dark btn-sm btn-block">Editar Perfil</a></div>
                                <div class="media-body mb-5 text-white">
                                    <h4 class="mt-0 mb-1">{{$comerciante->razaoSocial}}</h4>
                                    <p class="small mb-4"> <i class="fa fa-map-marker mr-2"></i>{{$comerciante->endereco}}</p>
                                </div>
                            </div>
                        </div>
            
                        <div class="bg-light p-4 d-flex justify-content-end text-center">
                            <ul class="list-inline mb-0">
                                <li class="list-inline-item">
                                <h5 class="font-weight-bold mb-0 d-block"><i class="far fa-calendar-alt mr-2"></i>Cadastrado em:</h5><small class="text-muted"> {{ date( 'd/m/Y' , strtotime($comerciante->created_at))}}</small>
                                </li>
                            </ul>
                        </div>
            
                        <div class="py-4 px-4">
                            <h5 class="mb-3"><i class="fas fa-info-circle mr-2"></i>Informações</h5>
                            <div class="p-4 bg-light rounded shadow-sm">
                                <p class="font-italic mb-3">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.</p>
                                <p class="font-italic mb-0"><i class="fas fa-lg fa-envelope mr-2"></i> Email: {{$comerciante->email}}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>                   
@endsection
