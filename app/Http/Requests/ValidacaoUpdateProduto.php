<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidacaoUpdateProduto extends FormRequest
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
            'nome' => 'required|string',
            'marca' => 'required|string',
            'descricao' => 'required|string',
            'valor' => 'required',
            'estoque' => 'required', 
            'unidadeVenda' => 'max:10', 
        ];
    }

    public function messages() {   
        return [     
            'required' => 'O campo é obrigatório', 
            'string' => 'O campo só aceita textos',
            'unidadeVenda.max' => 'O campo só poder receber até 10 carácteres'
        ]; 
    }
}
