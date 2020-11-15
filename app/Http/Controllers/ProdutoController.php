<?php

namespace App\Http\Controllers;

use App\Http\Requests\ValidacaoProduto;
use App\Http\Requests\ValidacaoUpdateProduto;
use App\Model\Produto;
use Illuminate\Support\Facades\Auth;
use App\Repositories\ImageRepository;
use Illuminate\Http\Request;

class ProdutoController extends Controller
{

    public function __construct()
    {
        //
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $produtos = Produto::where('representante_id', Auth::user()->id)->get();
        return view('produto.index')->with(['produtos'=> $produtos]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('produto.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ValidacaoProduto $request, Produto $produto, ImageRepository $repo)
    {
        $produto->nome = $request->nome;
        $produto->representante_id = Auth::user()->id;
        $produto->marca = $request->marca;
        $produto->descricao = $request->descricao;
        $produto->valor = $request->valor;

        // Moeda formato americano
        $request->valor = str_replace('.', '', $request->valor);
        $produto->price = str_replace(',', '.', $request->valor);
        $produto->unidadeVenda = $request->unidadeVenda;
        $produto->estoque = $request->estoque;
        
        $produto->imagem = $request->image;
        if ($request->hasFile('imagem') && $request->file('imagem')->isValid()) {
            $produto->imagem = $repo->saveImage($request->image, 'produto/'.$produto->representante_id, 250);
        }
        $produto->save();
        return redirect()->intended(route('produto.index'))->with('success_message', 'Produto cadastrado com sucesso!');;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $produto = Produto::find($id);
        return view('produto.show')->with(['produto'=>$produto]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $produto = Produto::find($id);
        return view('produto.edit')->with(['produto'=>$produto]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ValidacaoUpdateProduto $request, $id, ImageRepository $repo)
    {
        $produto = Produto::find($id);
        $produto->nome = $request->nome;
        $produto->marca = $request->marca;
        $produto->descricao = $request->descricao;
        $produto->valor = $request->valor;

        // Moeda formato americano
        $request->valor = str_replace('.', '', $request->valor);
        $produto->price = str_replace(',', '.', $request->valor);
        $produto->unidadeVenda = $request->unidadeVenda;
        $produto->estoque = $request->estoque;
 
        if ($request->hasFile('imagem') && $request->file('imagem')->isValid()) {
            // Verificar melhor a maneira de tirar o http://localhost:8000/
            $image = substr($produto->imagem, 22);
            unlink($image);
            $produto->imagem = $repo->saveImage($request->image, 'produto/'.$produto->representante_id, 250);
        }
        
        $produto->save();
        return redirect(\route('produto.index'))->with('success_message', 'Produto atualizado com sucesso!');;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
