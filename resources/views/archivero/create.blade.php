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

            <form method="POST" action="{{ route('archivero.store') }}" enctype="multipart/form-data" class="space-y-6"
                  x-data="{
                      archivos: [{ nombre: '', file: null, preview: '', esImagen: false, esPdf: false }],
                      agregar() {
                          this.archivos.push({ nombre: '', file: null, preview: '', esImagen: false, esPdf: false });
                      },
                      quitar(i) {
                          if (this.archivos.length > 1) this.archivos.splice(i, 1);
                      },
                      limpiar(i, ev) {
                          const fila = ev.currentTarget.closest('.fila-archivo');
                          const input = fila ? fila.querySelector('input[type=file]') : null;
                          if (input) input.value = '';
                          this.archivos[i] = { nombre: '', file: null, preview: '', esImagen: false, esPdf: false };
                      },
                      seleccionar(i, event) {
                          const f = event.target.files[0];
                          if (!f) {
                              this.archivos[i] = { nombre: '', file: null, preview: '', esImagen: false, esPdf: false };
                              return;
                          }
                          const esImagen = f.type.startsWith('image/') || /\.(jpe?g|png|gif|webp|bmp|svg)$/i.test(f.name);
                          const esPdf = f.type === 'application/pdf' || /\.pdf$/i.test(f.name);
                          let preview = '';
                          if (esImagen) {
                              const reader = new FileReader();
                              reader.onload = e => { this.archivos[i].preview = e.target.result; };
                              reader.readAsDataURL(f);
                          } else if (esPdf) {
                              preview = URL.createObjectURL(f);
                          }
                          this.archivos[i] = { nombre: f.name, file: f, preview, esImagen, esPdf };
                      }
                  }"
                  @submit="if (!archivos.some(a => a.file)) { $event.preventDefault(); alert('Selecciona al menos un archivo.'); return; } const btn = this.querySelector('button[type=submit]'); btn.disabled = true; btn.textContent = 'Subiendo...'">
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
                        Archivos <span class="text-red-400">*</span>
                    </label>
                    <div class="space-y-3">
                        <template x-for="(a, i) in archivos" :key="i">
                            <div class="border-2 border-dashed border-gray-200 rounded-2xl p-4 hover:border-educlub/40 hover:bg-educlub/5 transition-all fila-archivo">
                                <div class="flex items-center justify-between gap-3">
                                    <label class="flex-1 min-w-0 cursor-pointer">
                                        <span class="flex items-center gap-3 text-sm text-gray-600">
                                            <span class="shrink-0 w-10 h-10 bg-educlub/10 rounded-xl flex items-center justify-center">
                                                <svg class="w-5 h-5 text-educlub" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                                                </svg>
                                            </span>
                                            <span class="truncate" x-text="a.nombre || 'Selecciona un archivo...'"></span>
                                        </span>
                                        <input type="file" :name="'files[]'" class="hidden" @change="seleccionar(i, $event)">
                                    </label>
                                    <div class="flex items-center gap-1 shrink-0">
                                        <button type="button" @click="limpiar(i, $event)" x-show="a.file"
                                                class="p-2 text-gray-300 hover:text-red-500 hover:bg-red-50 rounded-xl transition-all" title="Eliminar este archivo (no lo sube)">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                        </button>
                                        <button type="button" @click="quitar(i)" x-show="!a.file && archivos.length > 1"
                                                class="p-2 text-gray-300 hover:text-red-500 hover:bg-red-50 rounded-xl transition-all" title="Quitar fila">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                                        </button>
                                    </div>
                                </div>
                                <img x-show="a.esImagen && a.preview" :src="a.preview" class="mt-3 max-h-40 mx-auto rounded-xl border border-gray-200 shadow-sm" alt="Vista previa">
                                <iframe x-show="a.esPdf && a.preview" :src="a.preview" class="mt-3 w-full h-60 rounded-xl border border-gray-200 shadow-sm"></iframe>
                            </div>
                        </template>
                    </div>
                    <button type="button" @click="agregar()"
                            class="mt-3 inline-flex items-center gap-2 text-sm font-semibold text-educlub hover:text-green-pastel transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                        Agregar otro archivo
                    </button>
                    <p class="mt-2 text-xs text-gray-400">
                        Máximo 20MB por archivo
                    </p>
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
@endsection
