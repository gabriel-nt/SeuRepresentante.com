<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidacaoUpdateRepresentante extends FormRequest
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
            'name' => 'required|string|max:200',
            'cpf' => 'required|cpf|formato_cpf',
            'email' => 'required',
        ];
    }

    public function messages() {   
        return [     
            'required' => 'O campo é obrigatório', 
            'cpf.cpf' => 'CPF inválido',
            'cpf.formato_cpf' => 'O formato do CPF está incorreto',
            'name.max' => 'O campo só poder receber até 200 carácteres',
            'email.email' => 'Somente emails válidos',
        ]; 
    }
}
