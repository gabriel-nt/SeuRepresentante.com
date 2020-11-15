<?php

namespace App\Model;

use App\Notifications\ResetSenhaRepresentante;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Representante extends Authenticatable
{

    use Notifiable;

    protected $guard = 'representante';

    public function getAuthPassword()
    {
        return $this->password;
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetSenhaRepresentante($token));
    }

    protected $fillable = [
        'empresa_id',
        'nome',
        'CPF',
        'email',
        'tipoProduto',
        'descricao',
        'password',     
        'imagem',
        'typeUser',
        'remember_token'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];
}
