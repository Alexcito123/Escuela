@extends('layouts.archivero')

@section('title', 'Subir Archivo')

@section('content')
    @include('archivero.partials.breadcrumb')

    <div class="max-w-2xl mx-auto">
        <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-8 sm:p-10">
            <div class="flex items-center gap-3 mb-6">
                <div class="w-12 h-12 bg-educlub/10 rounded-2xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-educlub" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                    </svg>
                </div>
                <div>
                    <h1 class="text-2xl font-bold text-gray-800">Subir Archivo</h1>
                    <p class="text-sm text-gray-400 mt-0.5">
                        a <span class="font-semibold text-gray-600">{{ $folder->name }}</span>
                        <span class="text-gray-300">·</span>
                        {{ $folder->grade->name }}
                    </p>
                </div>
            </div>

            <form method="POST" action="{{ route('archivero.store') }}" enctype="multipart/form-data" class="space-y-6">
                @csrf
                <input type="hidden" name="folder_id" value="{{ $folder->id }}">

                <div>
                    <label for="title" class="block text-sm font-semibold text-gray-700 mb-2">
                        Título <span class="text-red-400">*</span>
                    </label>
                    <input type="text" name="title" id="title" value="{{ old('title') }}" required maxlength="255"
                           class="input-field"
                           placeholder="Título del archivo">
                </div>

                <div>
                    <label for="description" class="block text-sm font-semibold text-gray-700 mb-2">
                        Descripción <span class="text-gray-400 font-normal">(opcional)</span>
                    </label>
                    <textarea name="description" id="description" rows="3" maxlength="1000"
                              class="input-field"
                              placeholder="Breve descripción del archivo">{{ old('description') }}</textarea>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Archivo <span class="text-red-400">*</span>
                    </label>
                    <div class="relative">
                        <div class="flex justify-center px-6 pt-8 pb-8 border-2 border-dashed border-gray-200 rounded-2xl hover:border-educlub/40 hover:bg-educlub/5 transition-all cursor-pointer"
                             onclick="document.getElementById('file').click()">
                            <div class="text-center">
                                <img id="file-preview" class="hidden max-h-56 mx-auto rounded-xl border border-gray-200 shadow-sm mb-3" alt="Vista previa">
                                <iframe id="file-preview-pdf" class="hidden w-full h-72 rounded-xl border border-gray-200 shadow-sm mb-3"></iframe>
                                <div id="file-placeholder">
                                    <div class="w-16 h-16 bg-educlub/10 rounded-2xl flex items-center justify-center mx-auto mb-3">
                                        <svg class="w-8 h-8 text-educlub" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                                        </svg>
                                    </div>
                                    <p class="text-sm text-gray-600 font-medium">
                                        <span class="text-educlub">Selecciona un archivo</span> o arrastra aquí
                                    </p>
                                    <p class="text-xs text-gray-400 mt-1">
                                        PDF, DOC, DOCX, XLS, XLSX, PPT, PPTX, JPG, PNG, GIF, MP4, MP3, ZIP, RAR (max 20MB)
                                    </p>
                                </div>
                            </div>
                        </div>
                        <input type="file" name="file" id="file" class="hidden" required
                               onchange="previewArchivo(this)">
                    </div>
                    <p id="file-name" class="mt-2.5 text-sm text-gray-400">Ningún archivo seleccionado</p>
                </div>

                <div class="flex items-center justify-between pt-6 border-t border-gray-100">
                    <a href="{{ route('archivero.folder', $folder) }}"
                       class="text-sm font-medium text-gray-500 hover:text-gray-700 transition-colors flex items-center gap-1.5">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                        Cancelar
                    </a>
                    <button type="submit" class="btn-primary !py-2.5 !px-6 text-sm">
                        Subir Archivo
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
                nombreEl.classList.remove('text-educlub');
                nombreEl.classList.add('text-gray-400');
                preview.classList.add('hidden');
                pdfPreview.classList.add('hidden');
                pdfPreview.src = '';
                placeholder.classList.remove('hidden');
                return;
            }

            nombreEl.textContent = file.name;
            nombreEl.classList.remove('text-gray-400');
            nombreEl.classList.add('text-educlub');

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
