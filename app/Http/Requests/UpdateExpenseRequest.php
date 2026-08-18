<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateExpenseRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'concepto' => 'required|string|max:255',
            'categoria' => 'required|in:Material escolar,Papelería,Servicios,Internet,Agua,Luz,Renta,Sueldos,Mantenimiento,Otros',
            'monto' => 'required|numeric|min:0.01|max:9999999.99',
            'fecha' => 'required|date',
            'proveedor' => 'nullable|string|max:255',
            'metodo_pago' => 'required|in:Efectivo,Transferencia,Tarjeta,Cheque,Otro',
            'observaciones' => 'nullable|string|max:1000',
        ];
    }

    public function messages(): array
    {
        return [
            'concepto.required' => 'El concepto es obligatorio.',
            'categoria.required' => 'La categoría es obligatoria.',
            'monto.required' => 'El monto es obligatorio.',
            'fecha.required' => 'La fecha es obligatoria.',
        ];
    }
}
