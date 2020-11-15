<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    protected $fillable = [
        'representante_id',
        'comerciante_id',
        'valorTotal',
        'subTotal'
    ];
}
