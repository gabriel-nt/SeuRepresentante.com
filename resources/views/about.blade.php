@extends('layouts.app')

@section('title')
    <title>SEUREPRESENTANTE.COM</title>
@endsection

@section('content')
<div class="container about-page">
    <div class="img-about" style="text-align:center">
        <img src="img/sobre.png" class="img-fluid"/>
    </div>
    <div class="row justify-content-center">
        <div class="col-10">
            <h2 id="benCom">Beneficios para o comerciante</h2>
            <p>O site seurepresentante.com foi criado com o intuito de auxiliar comerciantes que tenham certa dificuldades para encontrar e/ou conversar com vendedores desconhecidos.</p>
            <p>Com o sistema de busca, o comerciante encontrará uma lista com todos os representantes cadastrados no site, podendo assim entrar em contato com o mesmo. E além disto, o comerciante poderá ver, através de um mapa online, a localização dos vendedores, facilitando a procura pelos mesmos.</p>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-10">
            <h2 id="benVen">Beneficios para o representante</h2>
            <p>Vendedores e representantes comerciais, também, poderão usufruir de algumas vantagens do site, por exemplo: os vendedores receberão uma notificação por email, de que um cliente realizou um pedido e em anexo, receberá o PDF do pedido do cliente.</p>
            <p>E nas próximas atualizações, os vendedores, poderão utilizar o chat do site para se comunicar com seus cliente. Tudo isso em um lugar só.</p>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-10">
            <h2>Equipe</h2>
            <p>Desenvolvido e mantido por Gabriel Nunes Teixeira, para o trabalho de conclusão de curso (TCC) do curso técnico em Informática na escola Monteiro Lobato, ou simplesmente, Cimol.</p>
        </div>
    </div>
</div>
@endsection

@section('javascript')
    <script>
        // Inputmask para gerar as mascáras 
        $('#cnpj').inputmask("99.999.999/9999-99");
        $('#cpf').inputmask('999.999.999-99');
        $('#cnpjC').inputmask("99.999.999/9999-99");
        $('#cep').inputmask("99999-999");
    </script>
@endsection