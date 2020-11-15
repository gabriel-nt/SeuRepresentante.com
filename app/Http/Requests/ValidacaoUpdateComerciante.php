<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidacaoUpdateComerciante extends FormRequest
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
            'cnpj' => 'required|formato_cnpj',//|cnpj
            'email' => 'required|email',
            'endereco' => 'required|string',
            // 'imagemProfile' => 'required'
        ];
    }

    public function messages() {   
        return [     
            'required' => 'O campo é obrigatório', 
            'cnjp.formato_cnpj' => 'O formato do CNJP está incorreto',
            'razaoSocial.max' => 'O campo só poder receber até 200 carácteres',
            'email.email' => 'Somente emails válidos',
        ]; 
    }
}
