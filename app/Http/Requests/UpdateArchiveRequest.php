<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateArchiveRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'file' => 'nullable|file|max:20480|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx,jpg,jpeg,png,gif,mp4,mp3,zip,rar',
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'El título es requerido.',
            'file.max' => 'El archivo no puede exceder 20MB.',
            'file.mimes' => 'El tipo de archivo no está permitido.',
        ];
    }
}
