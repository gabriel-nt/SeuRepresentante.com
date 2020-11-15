<?php

namespace App\Model;

use App\Notifications\ResetSenhaComerciante;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Comerciante extends Authenticatable
{
    use Notifiable;

    protected $guard = 'comerciante';

    public function getAuthPassword()
    {
        return $this->password;
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetSenhaComerciante($token));
    }

    protected $fillable = [
        'razaoSocial',
        'CNPJ',
        'email',
        'password',
        'endereco',
        'imagem',
        'typeUser',
        'remember_token'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];
}