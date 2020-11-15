<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <title>PDF DO PEDIDO</title>
        <style>
   
            .clearfix:after {
                content: "";
                display: table;
                clear: both;
            }

            a {
                color: #0087C3;
                text-decoration: none;
            }

            body {
                position: relative;
                padding:0;
                margin: 0 auto;
                color: #555555;
                background: #FFFFFF;
                font-family: 'Source SansPro';
                font-size: 14px;
            }

            header {
                padding: 10px 0;
                margin-bottom: 20px;
                border-bottom: 1px solid #AAAAAA;
            }

            #logo {
                float: left;
                margin-top: 20px;
            }

            #logo img {
                width: 300px;
                height: auto
            }

            #company {
                text-align: right;
            }

            #details {
                margin-bottom: 50px;
            }

            #client {
                padding-left: 6px;
                border-left: 6px solid #0087C3;
                float: left;
            }

            #client .to {
                color: #777777;
            }

            h2.name {
                font-size: 1.4em;
                font-weight: normal;
                margin: 0;
            }

            #invoice h3 {
                color: #0087C3;
                font-size: 1.5em;
                line-height: 1em;
                font-weight: normal;
                margin: 0 0 10px 0;
                text-align: right;
            }

            #invoice .date {
                font-size: 1.1em;
                color: #777777;
                text-align: right;
            }

            table {
                width: 100%;
                border-collapse: collapse;
                border-spacing: 0;
                margin-bottom: 20px;
            }

            table th,
            table td {
                padding: 20px;
                background: #EEEEEE;
                text-align: center;
                border-bottom: 1px solid #FFFFFF;
            }

            table th {
                white-space: nowrap;
                font-weight: normal;
            }

            table td {
                text-align: right;
            }

            table td h3 {
                color: #57B223;
                font-size: 1.2em;
                font-weight: normal;
                margin: 0 0 0.2em 0;
            }

            table .no {
                color: #FFFFFF;
                font-size: 1.6em;
                background: #57B223;
            }

            table .desc {
                text-align: left;
            }

            table .unit {
                background: #DDDDDD;
            }

            table .qty {}

            table .total {
                background: #57B223;
                color: #FFFFFF;
            }

            table td.unit,
            table td.qty,
            table td.total {
                font-size: 1.2em;
            }

            table tbody tr:last-child td {
                border: none;
            }

            table tfoot td {
                padding: 10px 20px;
                background: #FFFFFF;
                border-bottom: none;
                font-size: 1.2em;
                white-space: nowrap;
                border-top: 1px solid #AAAAAA;
            }

            table tfoot tr:first-child td {
                border-top: none;
            }

            table tfoot tr:last-child td {
                color: #57B223;
                font-size: 1.4em;
                border-top: 1px solid #57B223;
            }

            table tfoot tr td:first-child {
                border: none;
            }

            #thanks {
                font-size: 2em;
                margin-bottom: 50px;
            }

            #notices {
                padding-left: 11px;
                border-left: 6px solid #0087C3;
            }

            #notices .notice {
                font-size: 1.2em;
            }

            footer {
                color: #777777;
                width: 100%;
                height: 30px;
                position: absolute;
                bottom: 0;
                border-top: 1px solid #AAAAAA;
                padding: 8px 0;
                text-align: center;
            }
        </style>
    </head>

    <body>
        <header class="clearfix">
            <div id="logo">
                <h2>SEUREPRESENTANTE.COM</h2>
            </div>
            <div id="company">
                <h2 class="name">SR.COM</h2>
                <div>Taquara, Rio Grande do Sul</div>
                <div>+ 55 51 99999-9999</div>
                <div>seurepresentante@gmail.com</div>
            </div>
            </div>
        </header>
        <main>
            @foreach($pedido as $data)
            <div id="details" class="clearfix">
                <div id="client">
                    <div class="to">Vendedor</div>
                    <h2 class="name">{{$data->nome}}</h2>
                    <div class="address">{{$data->CPF}}</div>
                    <div class="email">{{$data->emailRepresentante}}</div>
                </div>
                <div id="client" style="margin-left: 30px">
                    <div class="to">Comprador</div>
                    <h2 class="name">{{$data->razaoSocial}}</h2>
                    <div class="address">{{$data->CNPJ}}</div>
                    <div class="email">{{$data->emailComerciante}}</div>
                </div>
                <div id="invoice">
                    <h3>Data e Hora da Compra</h3>
                    <div class="date">{{date( 'd/m/Y H:i:s' , strtotime($data->created_at))}}</div>
                </div>
            </div>
            <table border="0" cellspacing="0" cellpadding="0">
                <thead>
                    <tr>
                        <th class="no">#</th>
                        <th class="desc">DESCRIÇÃO</th>
                        <th class="unit">R$ UNIN</th>
                        <th class="qty">QUANTIDADE</th>
                        <th class="total">R$ TOTAL</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($produtos as $produto)
                    <tr>
                        <td class="no">{{$produto->id}}</td>
                        <td class="desc">{{$produto->descricao}}</td>
                        <td class="unit">R$ {{$produto->valor}}</td>
                        <td class="qty">{{$produto->quantidade}}</td>
                        <td class="total">R$ {{$produto->price*$produto->quantidade}}</td>
                    </tr>
                @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="2"></td>
                        <td colspan="2">SUBTOTAL</td>
                        <td>R$ {{$data->subTotal}}</td>
                    </tr>
                    <tr>
                        <td colspan="2"></td>
                        <td colspan="2">QUANTIDADE</td>
                        <td>{{$data->quantidade}}</td>
                    </tr>
                    <tr>
                        <td colspan="2"></td>
                        <td colspan="2">TOTAL</td>
                        <td>R$ {{$data->valorTotal}}</td>
                    </tr>
                </tfoot>
            </table>
            @endforeach
            <div id="thanks">Obrigado por utilizar o nosso sistema!</div>
            <div id="notices">
                <div>AVISO:</div>
                <div class="notice">Sua lista de pedidos do seu usuário, também, foi atualizada.</div>
            </div>
        </main>
        <footer>
            © 2019 Copyright: seurepresentante.com
        </footer>
    </body>
</html>