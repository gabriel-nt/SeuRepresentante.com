<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidacaoEmpresa extends FormRequest
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
            'cnpj' => 'required|formato_cnpj|unique:empresas',//|cnpj
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
            'nome.max' => 'O campo só poder receber até 200 carácteres',
            'password.confirmed' => 'Senhas diferentes, as senhas devem ser indênticas',
        ]; 
    }
}
