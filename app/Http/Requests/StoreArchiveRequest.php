<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreArchiveRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'folder_id' => 'required|exists:folders,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'files' => 'required|array|min:1',
            'files.*' => 'required|file|max:20480|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx,jpg,jpeg,png,gif,mp4,mp3,zip,rar',
        ];
    }

    public function messages(): array
    {
        return [
            'folder_id.required' => 'La carpeta es requerida.',
            'folder_id.exists' => 'La carpeta seleccionada no existe.',
            'title.required' => 'El título es requerido.',
            'title.max' => 'El título no puede exceder 255 caracteres.',
            'files.required' => 'Debes seleccionar al menos un archivo.',
            'files.min' => 'Debes seleccionar al menos un archivo.',
            'files.*.max' => 'Un archivo no puede exceder 20MB.',
            'files.*.mimes' => 'Los archivos deben ser: pdf, doc, docx, xls, xlsx, ppt, pptx, jpg, jpeg, png, gif, mp4, mp3, zip, rar.',
        ];
    }
}
