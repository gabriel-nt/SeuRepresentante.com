<?php

namespace App\Model;

use App\Notifications\ResetSenhaEmpresa;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Empresa extends Authenticatable
{
    use Notifiable;

    protected $guard = 'empresa';

    public function getAuthPassword()
    {
        return $this->password;
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetSenhaEmpresa($token));
    }

    protected $fillable = [
        'nome',
        'CNPJ',
        'quantRepresentante',   
        'endereco',
        'password',
        'imagem',
        'typeUser',
        'remember_token'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];
}