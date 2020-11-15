<?php

namespace App\Http\Controllers;

use App\Model\Representante;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Route;

class LiveSearchController extends Controller
{
    function action(Request $request) {
        if($request->ajax()) {
            $query = $request->get('query');
            if($query != '') {
                $data = Representante::where('nome', 'like', '%'.$query.'%')
                                     ->orWhere('tipoProduto', 'like', '%'.$query.'%')
                                     ->get();
            } else {
                $data = Representante::all();
            }
            $output = '';
            $total_row = $data->count();
            if ($total_row > 0) {
                foreach ($data as $representante) {
                    if ($representante->descricao == null) {
                        $representante->descricao = 'Sem informações';
                    }

                    if($representante->imagem == null) {
                        $representante->imagem='img/sem-foto-perfil.jpg';
                    }

                    $output .= '
                        <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch">
                            <div class="card bg-light">
                                <div class="card-header text-muted border-bottom-0" style="background: transparent">
                                    Representante
                                </div>
                                <div class="card-body pt-0">
                                    <div class="row">
                                        <div class="col-7">
                                            <h2 class="lead"><b>'.$representante->nome.'</b></h2>
                                            <p class="text-muted text-sm"><b>Sobre: </b>'.$representante->descricao.' </p>
                                            <ul class="ml-4 mb-0 fa-ul text-muted">
                                            <li class="small mb-3"><span class="fa-li"><i class="fas fa-lg fa-shopping-cart"></i></span>Produtos: '.$representante->tipoProduto.'</li>
                                                <li class="small"><span class="fa-li"><i class="fas fa-lg fa-envelope"></i></span> Email:'.$representante->email.'</li>
                                            </ul>
                                        </div>
                                        <div class="col-5 text-center pl-2">
                                            <span class="img-profile elevation-2 img-fluid user-img" style="width: 110px; height: 110px; background-image: url( '. asset($representante->imagem).')"></span> 
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <div class="text-right">
                                        <a href="#" class="btn btn-sm btn-dg" disabled>
                                            <i class="fas fa-comments"></i>
                                        </a>
                                        <a href="'.route('representante.perfil', ['id' => $representante->id ]).'" class="btn btn-sm btn-wg">
                                            <i class="fas fa-user"></i> Ver Perfil
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    ';    
                }
            } else {
                $output = '
                    <div class="col-12" style="text-align:center">
                        <i class="fas fa-exclamation-circle fas-lg text-red mb-2 mr-3" style="font-size: 30px"></i>
                        <p class="align-items-center text-red">Nenhum resultado encontrado com '.$query.'</p>
                    </div>           
                ';
            }

            $data = array (
                'resultados' => $output
            );

            echo json_encode($data);
        }
    }
}
