<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePetRequest extends FormRequest
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
        return [
            'user_id' => 'nullable|exists:users,id',
            'name' => 'required|string|max:255',
            'species' => 'required|string|max:255',
            'race' => 'required|string|max:255',
            'age' => 'required|integer|min:0',
        ];
    }
    public function attributes()
    {
        return [
            'name' => 'Nombre de la mascota',
            'species' => 'Especie de la mascota',
            'race' => 'Raza de la mascota',
            'age' => 'Edad de la mascota',
        ];
    }
}
