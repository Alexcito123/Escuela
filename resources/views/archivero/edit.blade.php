@extends('layouts.archivero')

@section('title', 'Editar Archivo')

@section('content')
    @include('archivero.partials.breadcrumb')

    <div class="max-w-2xl mx-auto">
        <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-8 sm:p-10">
            <div class="flex items-center gap-3 mb-6">
                <div class="w-12 h-12 bg-orange-pastel/10 rounded-2xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-orange-pastel" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                    </svg>
                </div>
                <div>
                    <h1 class="text-2xl font-bold text-gray-800">Editar Archivo</h1>
                    <p class="text-sm text-gray-400 mt-0.5">
                        Editando: <span class="font-semibold text-gray-600">{{ $archive->original_name }}</span>
                    </p>
                </div>
            </div>

            <form method="POST" action="{{ route('archivero.update', $archive) }}" enctype="multipart/form-data" class="space-y-6">
                @csrf
                @method('PUT')

                <div>
                    <label for="title" class="block text-sm font-semibold text-gray-700 mb-2">
                        Título <span class="text-red-400">*</span>
                    </label>
                    <input type="text" name="title" id="title" value="{{ old('title', $archive->title) }}" required maxlength="255"
                           class="input-field">
                </div>

                <div>
                    <label for="description" class="block text-sm font-semibold text-gray-700 mb-2">
                        Descripción <span class="text-gray-400 font-normal">(opcional)</span>
                    </label>
                    <textarea name="description" id="description" rows="3" maxlength="1000"
                              class="input-field">{{ old('description', $archive->description) }}</textarea>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Archivo actual</label>
                    <div class="flex items-center gap-2.5 bg-gray-50 rounded-xl px-4 py-3">
                        <svg class="w-5 h-5 text-gray-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                        </svg>
                        <span class="text-sm text-gray-600 truncate">{{ $archive->original_name }}</span>
                    </div>
                    <label for="file" class="block text-sm font-semibold text-gray-700 mt-4 mb-2">
                        Reemplazar archivo <span class="text-gray-400 font-normal">(opcional)</span>
                    </label>
                    <div class="relative">
                        <div class="flex justify-center px-6 pt-6 pb-6 border-2 border-dashed border-gray-200 rounded-2xl hover:border-orange-pastel/40 hover:bg-orange-50/30 transition-all cursor-pointer"
                             onclick="document.getElementById('file').click()">
                            <div class="text-center">
                                <img id="file-preview" class="hidden max-h-56 mx-auto rounded-xl border border-gray-200 shadow-sm mb-3" alt="Vista previa">
                                <iframe id="file-preview-pdf" class="hidden w-full h-72 rounded-xl border border-gray-200 shadow-sm mb-3"></iframe>
                                <div id="file-placeholder">
                                    <div class="w-12 h-12 bg-orange-pastel/10 rounded-2xl flex items-center justify-center mx-auto mb-2">
                                        <svg class="w-6 h-6 text-orange-pastel" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/>
                                        </svg>
                                    </div>
                                    <p class="text-sm text-gray-600">
                                        <span class="font-medium text-orange-pastel">Selecciona un archivo</span> para reemplazar
                                    </p>
                                </div>
                            </div>
                        </div>
                        <input type="file" name="file" id="file" class="hidden"
                               onchange="previewArchivo(this)">
                    </div>
                    <p id="file-name" class="mt-2.5 text-sm text-gray-400">Ningún archivo seleccionado</p>
                </div>

                <div class="flex items-center justify-between pt-6 border-t border-gray-100">
                    <a href="{{ route('archivero.folder', $archive->folder) }}"
                       class="text-sm font-medium text-gray-500 hover:text-gray-700 transition-colors flex items-center gap-1.5">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                        Cancelar
                    </a>
                    <button type="submit"
                            class="inline-flex items-center gap-2 bg-orange-pastel hover:bg-orange-pastel-dark text-white font-semibold py-2.5 px-6 rounded-2xl transition-all duration-200 shadow-md hover:shadow-lg active:scale-[0.98] text-sm">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        Guardar Cambios
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function previewArchivo(input) {
            const file = input.files[0];
            const nombreEl = document.getElementById('file-name');
            const preview = document.getElementById('file-preview');
            const pdfPreview = document.getElementById('file-preview-pdf');
            const placeholder = document.getElementById('file-placeholder');

            if (!file) {
                nombreEl.textContent = 'Ningún archivo seleccionado';
                nombreEl.classList.remove('text-orange-pastel');
                nombreEl.classList.add('text-gray-400');
                preview.classList.add('hidden');
                pdfPreview.classList.add('hidden');
                pdfPreview.src = '';
                placeholder.classList.remove('hidden');
                return;
            }

            nombreEl.textContent = file.name;
            nombreEl.classList.remove('text-gray-400');
            nombreEl.classList.add('text-orange-pastel');

            const esImagen = file.type.startsWith('image/') || /\.(jpe?g|png|gif|webp|bmp|svg)$/i.test(file.name);
            const esPdf = file.type === 'application/pdf' || /\.pdf$/i.test(file.name);

            pdfPreview.classList.add('hidden');
            pdfPreview.src = '';
            preview.classList.add('hidden');

            if (esImagen) {
                const reader = new FileReader();
                reader.onload = (e) => {
                    preview.src = e.target.result;
                    preview.classList.remove('hidden');
                    placeholder.classList.add('hidden');
                };
                reader.readAsDataURL(file);
            } else if (esPdf) {
                pdfPreview.src = URL.createObjectURL(file);
                pdfPreview.classList.remove('hidden');
                placeholder.classList.add('hidden');
            } else {
                placeholder.classList.remove('hidden');
            }
        }
    </script>
@endsection
