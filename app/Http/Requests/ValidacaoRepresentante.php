<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidacaoRepresentante extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:200',
            'cpf' => 'required|formato_cpf|unique:representantes',//|cpf
            'email' => 'required|email|unique:representantes',
            'tipo' => 'required|string',
            'password' => 'required|string|confirmed',
            // 'imagemProfile' => 'required'
        ];
    }

    public function messages() {   
        return [     
            'required' => 'O campo é obrigatório', 
            'cpf.formato_cpf' => 'O formato do CPF está incorreto',
            'cpf.unique' => 'CPF já cadastrado, tente efetuar o login',
            'name.max' => 'O campo só poder receber até 200 carácteres',
            'email.email' => 'Somente emails válidos', 
            'email.unique' => 'Email já cadastrado, tente outro email',
            'imagem.mimes' => 'O arquivo inserido deve ser uma imagem',
            'password.confirmed' => 'Senhas diferentes, as senhas devem ser indênticas',
        ]; 
    }
}
