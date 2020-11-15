@extends('layouts.dashboard')

@section('title')
    <title>Dashboard</title>
@endsection

@include('representante.side-menu')

@section('content')
<div class="container">
    <div class="row mb-3">
        <div class="col-md-6 col-sm-10">
            @include('partials.alerts')
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