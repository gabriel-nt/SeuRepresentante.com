<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    protected $fillable = [
        'representante_id',
        'descricao',
        'marca',
        'valor',
        'price',
        'unidadeVenda',
        'estoque',
        'imagem'
    ];
}
