<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules()
    {
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $this->route('user'),
            'birthdate' => 'required|date',
        ];

        if ($this->isMethod('post') || $this->filled('password')) {
            $rules['password'] = 'required|string|min:6|confirmed';
        }

        return $rules;
    }

    public function attributes()
    {
        return [
            'name' => 'Nombre de Usuario',
            'email' => 'Correo electronico' . $this->route('user'),
            'birthdate' => 'Fecha de nacimiento',
        ];
    }
}
