@extends('layouts.archivero')

@section('title', 'Subir Archivo')

@section('content')
    @include('archivero.partials.breadcrumb')

    <div class="max-w-2xl mx-auto">
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-8">
            <h1 class="text-2xl font-bold text-gray-900 dark:text-white mb-2">Subir Archivo</h1>
            <p class="text-sm text-gray-500 dark:text-gray-400 mb-6">
                Carpeta: <span class="font-medium text-gray-700 dark:text-gray-300">{{ $folder->name }}</span>
                · Grado: <span class="font-medium text-gray-700 dark:text-gray-300">{{ $folder->grade->name }}</span>
            </p>

            <form method="POST" action="{{ route('archivero.store') }}" enctype="multipart/form-data" class="space-y-6">
                @csrf
                <input type="hidden" name="folder_id" value="{{ $folder->id }}">

                <div>
                    <label for="title" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                        Título <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="title" id="title" value="{{ old('title') }}" required maxlength="255"
                           class="w-full rounded-lg border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                           placeholder="Título del archivo">
                </div>

                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                        Descripción <span class="text-gray-400">(opcional)</span>
                    </label>
                    <textarea name="description" id="description" rows="3" maxlength="1000"
                              class="w-full rounded-lg border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                              placeholder="Breve descripción del archivo">{{ old('description') }}</textarea>
                </div>

                <div>
                    <label for="file" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                        Archivo <span class="text-red-500">*</span>
                    </label>
                    <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 dark:border-gray-600 border-dashed rounded-lg hover:border-blue-400 dark:hover:border-blue-500 transition cursor-pointer"
                         onclick="document.getElementById('file').click()">
                        <div class="text-center">
                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                            </svg>
                            <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">
                                <span class="font-medium text-blue-600 dark:text-blue-400 hover:text-blue-500">Selecciona un archivo</span> o arrastra aquí
                            </p>
                            <p class="mt-1 text-xs text-gray-500 dark:text-gray-500">
                                PDF, DOC, DOCX, XLS, XLSX, PPT, PPTX, JPG, PNG, GIF, MP4, MP3, ZIP, RAR (max 20MB)
                            </p>
                        </div>
                    </div>
                    <input type="file" name="file" id="file" class="hidden" required
                           onchange="document.getElementById('file-name').textContent = this.files[0]?.name || 'Ningún archivo seleccionado'">
                    <p id="file-name" class="mt-2 text-sm text-gray-500 dark:text-gray-400">Ningún archivo seleccionado</p>
                </div>

                <div class="flex items-center justify-between pt-4 border-t border-gray-200 dark:border-gray-700">
                    <a href="{{ route('archivero.folder', $folder) }}"
                       class="text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white transition">
                        Cancelar
                    </a>
                    <button type="submit"
                            class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg font-medium transition">
                        Subir Archivo
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
