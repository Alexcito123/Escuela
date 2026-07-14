<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateStudentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $studentId = $this->route('student');

        return [
            'nombre' => 'required|string|max:255',
            'apellido_paterno' => 'required|string|max:255',
            'apellido_materno' => 'required|string|max:255',
            'fecha_nacimiento' => 'required|date|before:today',
            'curp' => 'nullable|string|max:18|unique:students,curp,' . $studentId,
            'sexo' => 'required|in:Masculino,Femenino',
            'direccion' => 'required|string',
            'telefono' => 'required|string|max:20',
            'correo' => 'nullable|email|max:255',
            'nombre_tutor' => 'required|string|max:255',
            'telefono_tutor' => 'required|string|max:20',
            'correo_tutor' => 'nullable|email|max:255',
            'grade_id' => 'required|exists:grades,id',
            'grupo' => 'required|string|max:5',
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
            'apellido_materno.required' => 'El apellido materno es obligatorio.',
            'fecha_nacimiento.required' => 'La fecha de nacimiento es obligatoria.',
            'fecha_nacimiento.before' => 'La fecha de nacimiento debe ser anterior a hoy.',
            'curp.unique' => 'Ya existe un alumno con ese CURP.',
            'grade_id.required' => 'El grado es obligatorio.',
            'grade_id.exists' => 'El grado seleccionado no existe.',
            'grupo.required' => 'El grupo es obligatorio.',
            'fecha_ingreso.required' => 'La fecha de ingreso es obligatoria.',
            'estado.required' => 'El estado es obligatorio.',
            'fotografia.image' => 'La fotografía debe ser una imagen.',
            'fotografia.mimes' => 'La fotografía debe ser JPG, JPEG o PNG.',
            'fotografia.max' => 'La fotografía no debe exceder 2MB.',
        ];
    }
}
