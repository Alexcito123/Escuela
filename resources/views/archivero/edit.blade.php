@extends('layouts.archivero')

@section('title', 'Editar Archivo')

@section('content')
    @include('archivero.partials.breadcrumb')

    <div class="max-w-2xl mx-auto">
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-8">
            <h1 class="text-2xl font-bold text-gray-900 dark:text-white mb-2">Editar Archivo</h1>
            <p class="text-sm text-gray-500 dark:text-gray-400 mb-6">
                Editando: <span class="font-medium text-gray-700 dark:text-gray-300">{{ $archive->original_name }}</span>
            </p>

            <form method="POST" action="{{ route('archivero.update', $archive) }}" enctype="multipart/form-data" class="space-y-6">
                @csrf
                @method('PUT')

                <div>
                    <label for="title" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                        Título <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="title" id="title" value="{{ old('title', $archive->title) }}" required maxlength="255"
                           class="w-full rounded-lg border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                </div>

                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                        Descripción <span class="text-gray-400">(opcional)</span>
                    </label>
                    <textarea name="description" id="description" rows="3" maxlength="1000"
                              class="w-full rounded-lg border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">{{ old('description', $archive->description) }}</textarea>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                        Archivo actual
                    </label>
                    <div class="flex items-center space-x-2 text-sm text-gray-600 dark:text-gray-400">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                        </svg>
                        <span>{{ $archive->original_name }}</span>
                    </div>
                    <label for="file" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mt-4 mb-1">
                        Reemplazar archivo <span class="text-gray-400">(opcional)</span>
                    </label>
                    <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 dark:border-gray-600 border-dashed rounded-lg hover:border-blue-400 dark:hover:border-blue-500 transition cursor-pointer"
                         onclick="document.getElementById('file').click()">
                        <div class="text-center">
                            <svg class="mx-auto h-10 w-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
                            </svg>
                            <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">
                                <span class="font-medium text-blue-600 dark:text-blue-400">Selecciona un archivo</span> para reemplazar
                            </p>
                        </div>
                    </div>
                    <input type="file" name="file" id="file" class="hidden"
                           onchange="document.getElementById('file-name').textContent = this.files[0]?.name || 'Ningún archivo seleccionado'">
                    <p id="file-name" class="mt-2 text-sm text-gray-500 dark:text-gray-400">Ningún archivo seleccionado</p>
                </div>

                <div class="flex items-center justify-between pt-4 border-t border-gray-200 dark:border-gray-700">
                    <a href="{{ route('archivero.folder', $archive->folder) }}"
                       class="text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white transition">
                        Cancelar
                    </a>
                    <button type="submit"
                            class="bg-amber-600 hover:bg-amber-700 text-white px-6 py-2 rounded-lg font-medium transition">
                        Guardar Cambios
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
