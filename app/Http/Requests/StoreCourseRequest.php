<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCourseRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string|max:1000',
            'grade_id' => 'required|exists:grades,id',
            'teacher_id' => 'required|exists:teachers,id',
            'dia_semana' => 'nullable|string|max:20',
            'hora_inicio' => 'nullable|date_format:H:i',
            'hora_fin' => 'nullable|date_format:H:i|after:hora_inicio',
            'estado' => 'required|in:Activo,Inactivo',
        ];
    }

    public function messages(): array
    {
        return [
            'nombre.required' => 'El nombre del curso es obligatorio.',
            'grade_id.required' => 'El grado es obligatorio.',
            'grade_id.exists' => 'El grado seleccionado no existe.',
            'teacher_id.required' => 'El docente es obligatorio.',
            'teacher_id.exists' => 'El docente seleccionado no existe.',
            'hora_fin.after' => 'La hora de fin debe ser posterior a la hora de inicio.',
            'estado.required' => 'El estado es obligatorio.',
        ];
    }
}
