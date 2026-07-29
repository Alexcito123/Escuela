<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePaymentRequest extends FormRequest
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
            'monto.required' => 'El monto es obligatorio.',
            'fecha.required' => 'La fecha es obligatoria.',
            'concepto.required' => 'El concepto es obligatorio.',
        ];
    }
}
