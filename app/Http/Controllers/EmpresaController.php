<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Http\Requests\ValidacaoEmpresa;
use App\Model\Empresa;
use App\Repositories\ImageRepository;
use App\Http\Controllers\EmpresaAuth\LoginController as EmpresaLogin;

class EmpresaController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:empresa', ['except' => ['create', 'store']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('empresa.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('empresa.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ValidacaoEmpresa $request, Empresa $empresa ,ImageRepository $repo, EmpresaLogin $empresaLogin)
    {
        $empresa->nome = $request->name;
        $empresa->CNPJ = $request->cnpj;
        $empresa->endereco = $request->endereco;
        $empresa->typeUser = 'empresa';
        $empresa->remember_token = $request->_token;
        $empresa->senha = Hash::make($request->password);
        
        $empresa->imagem = $request->imagem;
        if ($request->hasFile('imagem') && $request->file('imagem')->isValid()) {
            $empresa->imagem = $repo->saveImage($request->imagem, 'empresa/profile', 250);
        }
        $empresa->save();
        $empresaLogin->login($request);
        return redirect()->intended(route('empresa.dashboard'))->with('success_message', 'Empresa cadastrada com sucesso!');;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $empresa = Empresa::find($id);
        return view('empresa.show')->with(['empresa'=>$empresa]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $empresa = Empresa::find($id);
        return view('empresa.edit')->with(['empresa'=>$empresa]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ValidacaoUpdateProfile $request, $id, ImageRepository $repo)
    {
        $empresa = Empresa::find($id);
        $empresa->nome = $request->name;
        $empresa->CNPJ = $request->cnpj;
        $empresa->endereco = $request->endereco;
 
        if ($request->hasFile('imagem') && $request->file('imagem')->isValid()) {
            // Verificar melhor a maneira de tirar o http://localhost:8000/
            $image = substr($empresa->imagem, 22);
            unlink($image);
            $empresa->imagem = $repo->saveImage($request->imagem, 'empresa/profile', 250);
        }
        
        $empresa->save();
        return redirect('/')->with('success_message', 'Empresa atualizada com sucesso!');;
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
