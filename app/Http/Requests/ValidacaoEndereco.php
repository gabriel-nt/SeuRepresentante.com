<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidacaoEndereco extends FormRequest
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
            'CEP' => 'required|string|min:9|max:9',
            'cidade' => 'required',
            'estado' => 'required',
        ];
    }

    public function messages() {   
        return [     
            'required' => 'O campo é obrigatório', 
            'min' => 'O campo deve ter 8 dígitos',
            'max' => 'O campo deve ter 8 dígitos',
        ]; 
    }
}
