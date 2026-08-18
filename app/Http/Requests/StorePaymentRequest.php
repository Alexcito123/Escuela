<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePaymentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'student_id' => 'required|exists:students,id',
            'monto' => 'required|numeric|min:0.01|max:9999999.99',
            'fecha' => 'required|date',
            'concepto' => 'required|in:Inscripción,Mensualidad,Material,Uniforme,Evento,Otro',
            'observaciones' => 'nullable|string|max:1000',
            'estado' => 'required|in:Pagado,Pendiente,Cancelado',
            'metodo_pago' => 'required|in:Efectivo,Transferencia,Tarjeta,Cheque,Otro',
            'referencia' => 'nullable|string|max:255',
        ];
    }

    public function messages(): array
    {
        return [
            'student_id.required' => 'El alumno es obligatorio.',
            'student_id.exists' => 'El alumno seleccionado no existe.',
            'monto.required' => 'El monto es obligatorio.',
            'monto.min' => 'El monto debe ser mayor a 0.',
            'fecha.required' => 'La fecha es obligatoria.',
            'concepto.required' => 'El concepto es obligatorio.',
            'estado.required' => 'El estado es obligatorio.',
            'metodo_pago.required' => 'El método de pago es obligatorio.',
        ];
    }
}
