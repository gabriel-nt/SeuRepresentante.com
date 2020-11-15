@extends('layouts.dashboard')

@section('title')
    <title>Lista de Representantes</title>
@endsection

@include('comerciante.side-menu')

@section('content')

    <div class="loader"></div>

    @if(count($representantes) > 0)
    <div class="col-12" style="padding: 0px">
        <form class="card card-sm form-search" href="#">
            <div class="card-body row no-gutters align-items-center">
                <div class="col-auto" style="padding: 0 15px">
                    <i class="fas fa-search"></i>
                </div>
                <div class="col" style="padding: 0 3px 0 15px">
                    <input class="form-control form-control-borderless" id="search" placeholder="Pesquise pelo nome ou pelo tipo de produto vendido">
                </div>
            </div>
        </form>
    </div>

    <div class="card card-solid">
        <div class="card-body pb-0">
            <div class="row d-flex align-items-stretch" id="representantes">
                
            </div>
        </div>
    </div>
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
    
    <h1 class="result-none">Oops! Nenhum representante encontrado!</h1>
    @endif
</section>

@endsection

@section('javascript')
    <script>
        $(document).ready(function() {
            fetch_search();

            function fetch_search(query = '') {
                $('body').addClass("loading");
                $.ajax({
                    url: "{{ route('comerciante.searchRepresentantes') }}",
                    method: 'GET',
                    data: {
                        query: query,
                    },
                    dataType: 'json',
                    success:function(data) {
                        $('body').removeClass("loading");
                        $('#representantes').html(data.resultados);
                    }
                });
            }

            $('#search').on('keyup' , function() {
                let query = $(this).val();
                fetch_search(query);
            });
        });      
    </script>
@endsection
