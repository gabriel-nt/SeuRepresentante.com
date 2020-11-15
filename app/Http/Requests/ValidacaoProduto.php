<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidacaoProduto extends FormRequest
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
            'nome' => 'required|string|max:200',
            'marca' => 'min:3',
            'descricao' => 'min:20|max:500',
            'valor' => 'required',
            'estoque' => 'required', 
            'unidadeVenda' => 'max:10', 
            // 'imagemProfile' => 'required'
        ];
    }

    public function messages() {   
        return [     
            'required' => 'O campo é obrigatório',
            'descricao.min' => 'O campo deve ter no mínimo 20 carácteres',
            'marca.min' => 'O campo deve ter no mínimo 3 carácteres',
            'nome.max' => 'O campo só poder receber até 200 carácteres',
            'descricao.max' => 'O campo só poder receber até 500 carácteres',
            'unidadeVenda.max' => 'O campo só aceita até 10 carácteres',
        ]; 
    }
}
