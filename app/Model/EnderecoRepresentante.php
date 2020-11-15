<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class EnderecoRepresentante extends Model
{
    protected $fillable = [
        'representante_id',
        'CEP',
        'bairro',
        'complemento',
        'rua',
        'estado',
        'cidade',
        'ibge'
    ];
}
