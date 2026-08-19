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

            <form method="POST" action="{{ route('archivero.update', $archive) }}" enctype="multipart/form-data" class="space-y-6"
                  x-data="{
                      archivos: [{ nombre: '', file: null }],
                      agregar() { this.archivos.push({ nombre: '', file: null }); },
                      quitar(i) { if (this.archivos.length > 1) this.archivos.splice(i, 1); },
                      seleccionar(i, event) {
                          const f = event.target.files[0];
                          if (!f) { this.archivos[i] = { nombre: '', file: null }; return; }
                          this.archivos[i] = { nombre: f.name, file: f };
                      }
                  }"
                  @submit="this.querySelector('button[type=submit]').disabled = true; this.querySelector('button[type=submit]').textContent = 'Guardando...'">
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
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Archivos actuales <span class="text-gray-400 font-normal">({{ count($archive->files) }})</span>
                    </label>
                    <div class="space-y-2">
                        @foreach ($archive->files as $file)
                            <div class="flex items-center gap-2.5 bg-gray-50 rounded-xl px-4 py-2.5">
                                <svg class="w-4 h-4 text-gray-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                                </svg>
                                <span class="text-sm text-gray-600 truncate">{{ $file['original_name'] }}</span>
                            </div>
                        @endforeach
                    </div>
                    <label class="block text-sm font-semibold text-gray-700 mt-4 mb-2">
                        Reemplazar archivos <span class="text-gray-400 font-normal">(opcional — sustituye todos los actuales)</span>
                    </label>
                    <div class="space-y-3">
                        <template x-for="(a, i) in archivos" :key="i">
                            <div class="flex items-center gap-3 border-2 border-dashed border-gray-200 rounded-xl p-3 hover:border-orange-pastel/40 hover:bg-orange-50/30 transition-all">
                                <label class="flex-1 min-w-0 cursor-pointer">
                                    <span class="flex items-center gap-2 text-sm text-gray-600">
                                        <svg class="w-4 h-4 text-orange-pastel shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/></svg>
                                        <span class="truncate" x-text="a.nombre || 'Selecciona un archivo...'"></span>
                                    </span>
                                    <input type="file" :name="'files[]'" class="hidden" @change="seleccionar(i, $event)">
                                </label>
                                <button type="button" @click="quitar(i)" x-show="archivos.length > 1"
                                        class="shrink-0 p-2 text-gray-300 hover:text-red-500 hover:bg-red-50 rounded-xl transition-all" title="Quitar archivo">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                                </button>
                            </div>
                        </template>
                    </div>
                    <button type="button" @click="agregar()"
                            class="mt-3 inline-flex items-center gap-2 text-sm font-semibold text-orange-pastel hover:text-orange-pastel-dark transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                        Agregar otro archivo
                    </button>
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
@endsection
