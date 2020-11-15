<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use App\Http\Requests\ValidacaoRepresentante;
use App\Http\Requests\ValidacaoUpdateRepresentante;
use App\Model\Representante;
use App\Repositories\ImageRepository;
use App\Http\Controllers\RepresentanteAuth\LoginController as RepresentanteLogin;
use App\Http\Requests\ValidacaoEndereco;
use App\Model\EnderecoRepresentante;
use App\Model\Pedido;
use App\Model\Produto;
use App\Model\Comerciante;
use App\Model\PedidoProduto;
use Auth;
use Illuminate\Support\Facades\DB;

class RepresentanteController extends Controller
{
   /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:representante',  ['except' => ['index', 'create', 'store']]);
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
        $users[] = Auth::guard('representante')->user();

        $endereco = EnderecoRepresentante::where('representante_id', Auth::user()->id)->get();
        $produtos = Produto::where('representante_id', Auth::user()->id);
        $comerciantes = Comerciante::all();
        $pedidos = Pedido::where('representante_id', Auth::user()->id);
        return view('representante.index')->with(['endereco' => $endereco, 'produtos' => $produtos->count(), 'comerciantes' => $comerciantes->count(), 'pedidos' => $pedidos->count()]);
    } 

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('representante.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ValidacaoRepresentante $request, Representante $representante, ImageRepository $repo, RepresentanteLogin $representanteLogin)
    {
        $representante->nome = $request->name;
        $representante->CPF = $request->cpf;
        $representante->descricao = $request->descricao;
        $representante->email = $request->email;
        $representante->tipoProduto = $request->tipo;
        $representante->typeUser = 'representante';
        $representante->remember_token = $request->_token;
        $representante->password = Hash::make($request->password);
        
        $representante->imagem = $request->imagemProfile;
        if ($request->hasFile('imagem') && $request->file('imagem')->isValid()) {
            $representante->imagem = $repo->saveImage($request->imagemProfile, 'representante/profile', 250);
        }
        $representante->save();
        $representanteLogin->login($request);
        return redirect()->intended(route('representante.dashboard'))->with('success_message', 'Cadastro realizado!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $representante = Representante::find($id);
        return view('representante.show')->with(['representante'=>$representante]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $representante = Representante::find($id);
        return view('representante.edit')->with(['representante'=>$representante]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ValidacaoUpdateRepresentante $request, $id, ImageRepository $repo)
    {
        $representante = Representante::find($id);
        $representante->nome = $request->name;
        $representante->CPF = $request->cpf;
        $representante->email = $request->email;
        $representante->descricao = $request->descricao;
        $representante->tipoProduto = $request->tipo;
 
        if ($request->hasFile('imagem') && $request->file('imagem')->isValid()) {
            // Verificar melhor a maneira de tirar o http://localhost:8000/
            $image = substr($representante->imagem, 22);
            unlink($image);
            $representante->imagem = $repo->saveImage($request->imagem, 'representante/profile', 250);
        }
        
        $representante->save();
        return redirect(\route('representante.dashboard'))->with('success_message', 'Perfil atualizado!');
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
     * Mostra os pedidos relacionados ao representante
     */
    public function showPedidos() {
        $pedidos = DB::table('pedidos')
        ->join('representantes', 'pedidos.representante_id', '=', 'representantes.id')
        ->join('comerciantes', 'pedidos.comerciante_id', '=', 'comerciantes.id')
        ->where('pedidos.representante_id', '=', Auth::user()->id)
        ->select('representantes.nome', 'representantes.CPF','comerciantes.razaoSocial', 'comerciantes.CNPJ', 'pedidos.valorTotal', 'pedidos.subTotal', 'pedidos.created_at', 'pedidos.id')
        ->get();

        return view('representante.pedidos')->with(['pedidos' => $pedidos]);
    }

    /**
     * Mostra os detalhes de um pedido
     * @param int $id
     */
    public function showPedido($id) {
        $pedido = DB::table('pedidos')
        ->join('representantes', 'pedidos.representante_id', '=', 'representantes.id')
        ->join('comerciantes', 'pedidos.comerciante_id', '=', 'comerciantes.id')
        ->join('pedido_produtos', 'pedido_produtos.pedido_id', '=', 'pedidos.id')
        ->where('pedidos.id', '=', $id)
        ->select('representantes.nome', 'representantes.CPF', 'representantes.email AS emailRepresentante','comerciantes.razaoSocial', 'comerciantes.CNPJ','comerciantes.email AS emailComerciante', 'pedidos.valorTotal', 'pedidos.subTotal', 'pedidos.created_at', 'pedidos.id')
        ->get();

        $produtos = DB::table('produtos')
        ->join('pedido_produtos', 'produtos.id', '=', 'pedido_produtos.produto_id')
        ->join('pedidos', 'pedidos.id', '=', 'pedido_produtos.pedido_id')
        ->where('pedidos.id' , '=', $id)
        ->select('produtos.*', 'pedido_produtos.quantidade')
        ->get();

        return view('representante.showPedido')->with(['pedido' => $pedido, 'produtos' => $produtos]);
    }

    /**
     * Mostra o formulário para definir a lozalização
     */
    public function location() {
        return view('representante.location');
    }

    /**
     * Cadastra o endereço do representante
     */
    public function storeLocation(ValidacaoEndereco $request, EnderecoRepresentante $enderecoRepresentante) {
        $enderecoRepresentante->representante_id = Auth::user()->id;
        $enderecoRepresentante->CEP = $request->CEP;
        $enderecoRepresentante->bairro = $request->bairro;
        $enderecoRepresentante->complemento = $request->complemento;
        $enderecoRepresentante->rua = $request->rua;
        $enderecoRepresentante->estado =  $request->estado;
        $enderecoRepresentante->cidade = $request->cidade;
        $enderecoRepresentante->ibge = $request->ibge;
        $enderecoRepresentante->save();

        $representante = Representante::find(Auth::user()->id);
        $representante->localizacao = $enderecoRepresentante->id;
        $representante->save();
        
        return redirect(\route('representante.dashboard'))->with('success_message', 'Localização definida!');
    }
    
    public function showLocation($id){
        $endereco = EnderecoRepresentante::find($id);
        return view('representante.showLocation')->with(['endereco'=>$endereco]);
    }

    /**
     * Mostra o formulário para editar o endereco
     */
    public function editLocation($id) {
        $endereco = EnderecoRepresentante::find($id);
        return view('representante.editLocation')->with(['endereco'=>$endereco]);
    }

    /**
     * Atualiza a localização do representante
     */
    public function updateLocation(ValidacaoEndereco $request, $id) {
        $enderecoRepresentante = EnderecoRepresentante::find($id);
        $enderecoRepresentante->CEP = $request->CEP;
        $enderecoRepresentante->bairro = $request->bairro;
        $enderecoRepresentante->complemento = $request->complemento;
        $enderecoRepresentante->rua = $request->rua;
        $enderecoRepresentante->estado =  $request->estado;
        $enderecoRepresentante->cidade = $request->cidade;
        $enderecoRepresentante->ibge = $request->ibge;

        $enderecoRepresentante->save();
        return redirect(\route('representante.dashboard'))->with('success_message', 'Localização atualizada!');;
    }
}
