<?php

namespace App\Http\Controllers;

use Auth;
use PDF;
use App\Model\Produto;
use App\Model\Pedido;
use App\Model\PedidoProduto;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\EmailPedido;
use Illuminate\Support\Facades\File;

class PedidoController extends Controller
{
    /**
     * Mostra os detalhes de um pedido
     * @param int $id
     */
    public function show($id) {
        $pedido = DB::table('pedidos')
        ->join('representantes', 'pedidos.representante_id', '=', 'representantes.id')
        ->join('comerciantes', 'pedidos.comerciante_id', '=', 'comerciantes.id')
        ->join('pedido_produtos', 'pedido_produtos.pedido_id', '=', 'pedidos.id')
        ->where('pedidos.id', '=', $id)
        ->select('representantes.nome', 'representantes.CPF', 'representantes.email AS emailRepresentante', DB::raw('SUM(pedido_produtos.quantidade) as quantidade'),'comerciantes.razaoSocial', 'comerciantes.CNPJ','comerciantes.email AS emailComerciante', 'pedidos.valorTotal', 'pedidos.subTotal', 'pedidos.created_at', 'pedidos.id')
        ->get();

        $produtos = DB::table('produtos')
        ->join('pedido_produtos', 'produtos.id', '=', 'pedido_produtos.produto_id')
        ->join('pedidos', 'pedidos.id', '=', 'pedido_produtos.pedido_id')
        ->where('pedidos.id' , '=', $id)
        ->select('produtos.*', 'pedido_produtos.quantidade')
        ->get();

        return view('pedido.show')->with(['pedido' => $pedido, 'produtos' => $produtos]);
    }

    /**
     * Cria o pedido
     */
    public function store(Request $request, Pedido $pedido) {
        $idTemp = 0;
        $isValid  = true;
        $idRepresentantes = [];

        $pedido->comerciante_id = $request->comercianteId;
        $pedido->valorTotal = $request->total;
        $pedido->subTotal = $request->discount;

        foreach (Cart::content() as $key => $value) {
            $id = $value->model->id;
            $produto = Produto::find($id);
            $representanteId = $produto->representante_id;
            array_push($idRepresentantes, $representanteId);
        }

        foreach ($idRepresentantes as $key => $id) {
            if ($key == 0) {
                $idTemp = $id;
            } else {
                if ($idTemp != $id) {
                    $isValid = false;
                } 
            }
        }

        if ($isValid) {
            $pedido->representante_id = $idRepresentantes[0];
            $pedido->save();

            foreach (Cart::content() as $item) {
                $pedidoProduto = new PedidoProduto();
                $pedidoProduto->quantidade = $item->qty;
                $pedidoProduto->produto_id = $item->model->id;
                $pedidoProduto->pedido_id = $pedido->id;

                $produto = Produto::find($item->model->id);
                $produto->estoque = $produto->estoque - $item->qty;

                $produto->save();
                $pedidoProduto->save();
            }
            
            $this->sendEmail($pedido->id);
            Cart::destroy();

            return redirect(\route('comerciante.dashboard'))->with('success_message', 'Seu pedido foi efetuado com sucesso!');
        } else {
            return back()->with('error_message', 'Não pode haver produtos de diferentes representantes. Limpe seu carrinho e 
            refaça novamente, ou remova os item de um determinado representante');
        }     
    }
    
    /**
     * Envia um emial com o pedido
     */
    public function sendEmail($id) {

        $pedido = DB::table('pedidos')
        ->join('representantes', 'pedidos.representante_id', '=', 'representantes.id')
        ->join('comerciantes', 'pedidos.comerciante_id', '=', 'comerciantes.id')
        ->join('pedido_produtos', 'pedido_produtos.pedido_id', '=', 'pedidos.id')
        ->where('pedidos.id', '=', $id)
        ->select('representantes.nome', 'representantes.CPF', 'representantes.email AS emailRepresentante', DB::raw('SUM(pedido_produtos.quantidade) as quantidade'),'comerciantes.razaoSocial', 'comerciantes.CNPJ','comerciantes.email AS emailComerciante', 'pedidos.valorTotal', 'pedidos.subTotal', 'pedidos.created_at', 'pedidos.id')
        ->get();

        $produtos = DB::table('produtos')
        ->join('pedido_produtos', 'produtos.id', '=', 'pedido_produtos.produto_id')
        ->join('pedidos', 'pedidos.id', '=', 'pedido_produtos.pedido_id')
        ->where('pedidos.id' , '=', $id)
        ->select('produtos.*', 'pedido_produtos.quantidade')
        ->get();

        foreach($pedido as $data) {
            Mail::to($data->emailRepresentante)->send(new EmailPedido($data, $produtos));
            Mail::to($data->emailComerciante)->send(new EmailPedido($data, $produtos));
        }
    }

    /**
     * Gera um PDF do pedido
     */
    public function makePDF($id) {

        $pedido = DB::table('pedidos')
        ->join('representantes', 'pedidos.representante_id', '=', 'representantes.id')
        ->join('comerciantes', 'pedidos.comerciante_id', '=', 'comerciantes.id')
        ->join('pedido_produtos', 'pedido_produtos.pedido_id', '=', 'pedidos.id')
        ->where('pedidos.id', '=', $id)
        ->select('representantes.nome', 'representantes.CPF', 'representantes.email AS emailRepresentante', DB::raw('SUM(pedido_produtos.quantidade) as quantidade'),'comerciantes.razaoSocial', 'comerciantes.CNPJ','comerciantes.email AS emailComerciante', 'pedidos.valorTotal', 'pedidos.subTotal', 'pedidos.created_at', 'pedidos.id')
        ->get();

        $produtos = DB::table('produtos')
        ->join('pedido_produtos', 'produtos.id', '=', 'pedido_produtos.produto_id')
        ->join('pedidos', 'pedidos.id', '=', 'pedido_produtos.pedido_id')
        ->where('pedidos.id' , '=', $id)
        ->select('produtos.*', 'pedido_produtos.quantidade')
        ->get();

        $pdf = PDF::loadView('pdf.pdf', compact('pedido', 'produtos'));

        return $pdf->stream();
    }

    /**
     * Gera o pdf e baixa automaticamente
     */
    public function downloadPDF($id) {
        
        $pedido = DB::table('pedidos')
        ->join('representantes', 'pedidos.representante_id', '=', 'representantes.id')
        ->join('comerciantes', 'pedidos.comerciante_id', '=', 'comerciantes.id')
        ->join('pedido_produtos', 'pedido_produtos.pedido_id', '=', 'pedidos.id')
        ->where('pedidos.id', '=', $id)
        ->select('representantes.nome', 'representantes.CPF', 'representantes.email AS emailRepresentante', DB::raw('SUM(pedido_produtos.quantidade) as quantidade'),'comerciantes.razaoSocial', 'comerciantes.CNPJ','comerciantes.email AS emailComerciante', 'pedidos.valorTotal', 'pedidos.subTotal', 'pedidos.created_at', 'pedidos.id')
        ->get();

        $produtos = DB::table('produtos')
        ->join('pedido_produtos', 'produtos.id', '=', 'pedido_produtos.produto_id')
        ->join('pedidos', 'pedidos.id', '=', 'pedido_produtos.pedido_id')
        ->where('pedidos.id' , '=', $id)
        ->select('produtos.*', 'pedido_produtos.quantidade')
        ->get();

        $pdf = PDF::loadView('pdf.pdf', compact('pedido', 'produtos'));

        return $pdf->download('pedido.pdf');
    }
}
