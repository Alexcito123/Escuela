<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTeacherRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $teacherId = $this->route('teacher');

        return [
            'nombre' => 'required|string|max:255',
            'apellido_paterno' => 'required|string|max:255',
            'apellido_materno' => 'required|string|max:255',
            'fecha_nacimiento' => 'required|date|before:today',
            'curp' => 'nullable|string|max:18|unique:teachers,curp,' . $teacherId,
            'sexo' => 'required|in:Masculino,Femenino',
            'direccion' => 'required|string',
            'telefono' => 'required|string|max:20',
            'correo' => 'nullable|email|max:255',
            'especialidad' => 'required|string|max:255',
            'cedula_profesional' => 'nullable|string|max:255',
            'fecha_ingreso' => 'required|date',
            'estado' => 'required|in:Activo,Inactivo',
            'fotografia' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ];
    }

    public function messages(): array
    {
        return [
            'nombre.required' => 'El nombre es obligatorio.',
            'apellido_paterno.required' => 'El apellido paterno es obligatorio.',
            'fecha_nacimiento.required' => 'La fecha de nacimiento es obligatoria.',
            'curp.unique' => 'Ya existe un docente con ese CURP.',
            'especialidad.required' => 'La especialidad es obligatoria.',
            'telefono.required' => 'El teléfono es obligatorio.',
            'fecha_ingreso.required' => 'La fecha de ingreso es obligatoria.',
        ];
    }
}
