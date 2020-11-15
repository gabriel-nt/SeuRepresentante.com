<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class PedidoProduto extends Model
{
    protected $fillable = [
        'produto_id',
        'quantidade'
    ];
}
