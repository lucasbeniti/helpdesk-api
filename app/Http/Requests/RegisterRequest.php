<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users,email',
            'password' => 'required|string|min:6'
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'O nome é obrigatório.',
            'name.string'   => 'O nome deve ser um texto válido.',
            'name.max'      => 'O nome não pode ter mais que 255 caracteres.',

            'email.required' => 'O e-mail é obrigatório.',
            'email.string'   => 'O e-mail deve ser um texto válido.',
            'email.email'    => 'O e-mail deve ter um formato válido.',
            'email.unique'   => 'Este e-mail já está cadastrado.',

            'password.required' => 'A senha é obrigatória.',
            'password.string'   => 'A senha deve ser um texto válido.',
            'password.min'      => 'A senha deve ter no mínimo 6 caracteres.',
        ];
    }
}
