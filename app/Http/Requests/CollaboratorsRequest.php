<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CollaboratorsRequest extends FormRequest
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
        $id = $this->route('id') ?? null;

        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:collaborators,email,' . $id,
            'position' => 'nullable|string|max:255',
            'department' => 'nullable|string|max:255',
        ];

        if ($this->method() === 'POST') {
            $rules['password'] = 'required|string|min:6';
        } else {
            $rules['password'] = 'nullable|string|min:6';
        }

        return $rules;
    }

    /**
     * Get the validation attributes that apply to the request.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            //
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
            //
        ];
    }
}
