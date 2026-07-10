<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreFolderRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'grade_id' => 'required|exists:grades,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
        ];
    }

    public function messages(): array
    {
        return [
            'grade_id.required' => 'El grado es requerido.',
            'grade_id.exists' => 'El grado seleccionado no existe.',
            'name.required' => 'El nombre de la carpeta es requerido.',
        ];
    }
}
