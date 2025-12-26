<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OmbudsmanRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // only allow updates if the user is logged in
        return backpack_auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'type' => 'required|in:complaint,suggestion,compliment',
            'subject' => 'required|min:5|max:255',
            'message' => 'required|min:10',
            'email' => 'nullable|email',
            'name' => 'nullable|max:255',
        ];
    }

    /**
     * Get the validation attributes that apply to the request.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'type' => 'tipo',
            'subject' => 'assunto',
            'message' => 'mensagem',
            'email' => 'e-mail',
            'name' => 'nome',
        ];
    }

    /**
     * Get the validation messages that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'required' => 'O campo :attribute é obrigatório.',
            'min' => 'O campo :attribute deve ter no mínimo :min caracteres.',
            'max' => 'O campo :attribute deve ter no máximo :max caracteres.',
            'email' => 'O campo :attribute deve ser um endereço de e-mail válido.',
            'in' => 'O valor selecionado para :attribute é inválido.',
        ];
    }
}
