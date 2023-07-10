<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateUserRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
        ];
    }

    public function messages()
{
    return [
        'name.required' => 'O nome é obrigatório',
        'email.required' => 'O e-mail é obrigatório',
        'email.email' => 'O e-mail informado não é válido',
        'email.unique' => 'Este e-mail já está em uso',
        'password.required' => 'A senha é obrigatória',
        'password.min' => 'A senha deve ter no mínimo 8 caracteres',
    ];
}
}