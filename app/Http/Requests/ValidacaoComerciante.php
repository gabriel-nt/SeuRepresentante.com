<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidacaoComerciante extends FormRequest
{
    /**
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Regras de validações.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'razaoSocial' => 'required|string|max:200',
            'cnpj' => 'required|formato_cnpj|unique:comerciantes',//|cnpj
            'email' => 'required|email|unique:comerciantes',
            'endereco' => 'required|string',
            'password' => 'required|string|confirmed',
            // 'imagemProfile' => 'required'
        ];
    }

    public function messages() {   
        return [     
            'required' => 'O campo é obrigatório', 
            'cnjp.formato_cnpj' => 'O formato do CNJP está incorreto',
            'cnpj.unique' => 'CNPJ já cadastrado, tente efetuar o login',
            'razaoSocial.max' => 'O campo só poder receber até 200 carácteres',
            'email.email' => 'Somente emails válidos', 
            'email.unique' => 'Email já cadastrado, tente outro email',
            'imagem.mimes' => 'O arquivo inserido deve ser uma imagem',
            'password.confirmed' => 'Senhas diferentes, as senhas devem ser indênticas',
        ]; 
    }
}
