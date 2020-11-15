<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\ValidacaoComerciante;
use App\Http\Requests\ValidacaoUpdateComerciante;
use App\Model\Comerciante;
use App\Repositories\ImageRepository;
use App\Http\Controllers\ComercianteAuth\LoginController as ComercianteLogin;
use App\Model\EnderecoRepresentante;
use App\Model\Representante;
use App\Model\Produto;
use App\Model\Pedido;
use Auth;
use Illuminate\Support\Facades\DB;

class ComercianteController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:comerciante', ['except' => ['index', 'create', 'store']]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users[] = Auth::user();
        $users[] = Auth::guard()->user();
        $users[] = Auth::guard('comerciante')->user();

        $representantes = Representante::all();
        $pedidos = Pedido::where('comerciante_id', Auth::user()->id);
        return view('comerciante.index')->with(['representantes' => $representantes->count(), 'pedidos' => $pedidos->count()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('comerciante.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ValidacaoComerciante $request, Comerciante $comerciante, ImageRepository $repo, ComercianteLogin $comercianteLogin)
    {
        $comerciante->razaoSocial = $request->razaoSocial;
        $comerciante->CNPJ = $request->cnpj;
        $comerciante->email = $request->email;
        $comerciante->endereco = $request->endereco;
        $comerciante->typeUser = 'comerciante';
        $comerciante->remember_token = $request->_token;
        $comerciante->password = Hash::make($request->password);
        
        $comerciante->imagem = $request->imagemProfile;
        if ($request->hasFile('imagem') && $request->file('imagem')->isValid()) {
            $comerciante->imagem = $repo->saveImage($request->imagemProfile, 'comerciante/profile', 250);
        }
        $comerciante->save();
        $comercianteLogin->login($request);
        return redirect()->intended(route('comerciante.dashboard'))->with('success_message', 'Cadastro realizado com sucesso!');;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $comerciante = Comerciante::find($id);
        return view('comerciante.show')->with(['comerciante'=>$comerciante]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $comerciante = Comerciante::find($id);
        return view('comerciante.edit')->with(['comerciante'=>$comerciante]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\ValidacaoComerciante $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ValidacaoUpdateComerciante $request, $id, ImageRepository $repo)
    {
        $comerciante = Comerciante::find($id);
        $comerciante->razaoSocial = $request->razaoSocial;
        $comerciante->CNPJ = $request->cnpj;
        $comerciante->email = $request->email;
        $comerciante->endereco = $request->endereco;
 
        if ($request->hasFile('imagem') && $request->file('imagem')->isValid()) {
            // Verificar melhor a maneira de tirar o http://localhost:8000/
            $image = substr($comerciante->imagem, 22);
            unlink($image);
            $comerciante->imagem = $repo->saveImage($request->imagemProfile, 'comerciante/profile', 160);
        }
        
        $comerciante->save();
        return redirect(\route('comerciante.dashboard'))->with('success_message', 'Perfil atualizado com sucesso!');;
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


    /**
     * Lista de representantes cadastrados no sistemas
     */
    public function representantesList() {
        $representantes = Representante::all();
        return view('comerciante.listRepresentantes')->with(['representantes'=>$representantes]);
    } 

    /**
     * Mostra o perfil do representante, assim como seus produtos cadastrados e sua lozalização atual
     */
    public function showRepresentante($id) {
        $representante = Representante::find($id);
        $produtos = Produto::where('representante_id', $id)->get();
        $localizacao = EnderecoRepresentante::where('representante_id', $id)->get();
        return view('comerciante.showRepresentante')->with(['representante' => $representante , 'produtos' => $produtos, 'localizacao' => $localizacao]);
    }

    /**
     * Mostra os produtos do representante
     */
    public function productsByRepresentante() {
        $resultados = Produto::join('representantes', 'produtos.representante_id', '=', 'representantes.id')
        ->select('representantes.*')
        ->get();

        $representantes = [];

        foreach ($resultados as $value) {
            if (count($representantes) == 0) {
                array_push($representantes, $value);
            } else {
                $isExists = false;
                foreach ($representantes as $representante) {
                    if ($representante->id == $value->id) {
                        $isExists = true;
                    }
                }

                if ($isExists == false) {
                    array_push($representantes, $value); 
                }
            }
        }

        $produtos = Produto::all();
        return view('comerciante.products')->with(['representantes' => $representantes, 'produtos' => $produtos]);
    }

    /**
     * Mostra os pedidos relacionados ao representante
     */
    public function showPedidos() {
        $pedidos = DB::table('pedidos')
        ->join('representantes', 'pedidos.representante_id', '=', 'representantes.id')
        ->join('comerciantes', 'pedidos.comerciante_id', '=', 'comerciantes.id')
        ->where('pedidos.comerciante_id', '=', Auth::user()->id)
        ->select('representantes.nome', 'representantes.CPF','comerciantes.razaoSocial','comerciantes.CNPJ', 'pedidos.valorTotal', 'pedidos.subTotal', 'pedidos.created_at', 'pedidos.id')
        ->get();
        
        return view('comerciante.pedidos')->with(['pedidos' => $pedidos]);
    }
}
