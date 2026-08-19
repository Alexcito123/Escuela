@extends('layouts.archivero')

@section('title', $grade->name)

@section('content')
    @include('archivero.partials.breadcrumb')

    <div x-data="{
        folderModal: false,
        editModal: false,
        editId: null,
        editName: '',
        editDesc: '',
        folders: @js($folders->map(fn($f) => ['id' => $f->id, 'name' => $f->name, 'desc' => $f->description ?? ''])->values())
    }">
        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 mb-8">
            <div>
                <h1 class="text-2xl sm:text-3xl font-extrabold text-gray-800">{{ $grade->name }}</h1>
                <p class="text-sm text-gray-400 mt-1">{{ $folders->count() }} carpetas disponibles</p>
            </div>
            <div class="flex items-center gap-3">
                <button @click="editModal = true; editId = null"
                        class="px-4 py-2.5 text-sm font-semibold text-green-pastel border border-green-pastel/30 hover:bg-green-50 rounded-xl transition-all flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                    Editar Carpetas
                </button>
                <button @click="folderModal = true"
                        class="btn-primary !py-2.5 !px-5 text-sm flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    Nueva Carpeta
                </button>
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @forelse ($folders as $folder)
                <div class="group relative bg-white rounded-2xl shadow-sm hover:shadow-lg border border-gray-100 transition-all duration-300 hover:-translate-y-1 hover:border-green-pastel/30 overflow-hidden">
                    <div class="absolute top-0 right-0 w-24 h-24 bg-green-pastel/10 rounded-full -translate-y-1/2 translate-x-1/2 group-hover:scale-150 transition-transform duration-500"></div>
                    <a href="{{ route('archivero.folder', $folder) }}" class="block relative p-6">
                        <div class="flex items-start gap-4">
                            <div class="shrink-0 w-14 h-14 bg-gradient-to-br from-green-pastel to-green-pastel-dark rounded-2xl flex items-center justify-center shadow-sm">
                                <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"/>
                                </svg>
                            </div>
                            <div class="flex-1 min-w-0">
                                <h3 class="text-lg font-bold text-gray-800 truncate group-hover:text-green-pastel transition-colors">{{ $folder->name }}</h3>
                                @if ($folder->description)
                                    <p class="text-xs text-gray-400 mt-1 truncate">{{ $folder->description }}</p>
                                @endif
                                <p class="text-sm text-gray-400 mt-3 flex items-center gap-1.5">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>
                                    {{ $folder->archives_count }} archivos
                                </p>
                            </div>
                            <svg class="w-5 h-5 text-gray-300 group-hover:text-green-pastel transition-all group-hover:translate-x-1 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </div>
                    </a>
                    <button type="button" @click="editId = {{ $folder->id }}; editName = @js($folder->name); editDesc = @js($folder->description ?? ''); editModal = true"
                            class="absolute top-3 right-3 z-10 p-2 text-gray-300 hover:text-green-pastel hover:bg-green-50 rounded-xl transition-all"
                            title="Editar carpeta">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                    </button>
                </div>
            @empty
                <div class="col-span-full text-center py-16">
                    <div class="w-20 h-20 bg-gray-100 rounded-3xl flex items-center justify-center mx-auto mb-4">
                        <svg class="w-10 h-10 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-700 mb-1">No hay carpetas</h3>
                    <p class="text-sm text-gray-400 mb-6">Este grado aún no tiene carpetas. Crea la primera.</p>
                    <button @click="folderModal = true"
                            class="btn-primary !py-2.5 !px-6 text-sm">
                        Crear Primera Carpeta
                    </button>
                </div>
            @endforelse
        </div>

        {{-- Create Folder Modal --}}
        <div x-show="folderModal" x-transition.opacity class="fixed inset-0 bg-black/40 z-50 overflow-y-auto p-4 flex items-center justify-center backdrop-blur-sm"
             @click.self="folderModal = false">
            <div class="bg-white rounded-3xl shadow-2xl w-full max-w-md p-8 relative">
                <button type="button" @click="folderModal = false" class="absolute top-4 right-4 text-gray-300 hover:text-gray-500 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-10 h-10 bg-green-pastel/10 rounded-2xl flex items-center justify-center">
                        <svg class="w-5 h-5 text-green-pastel" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"/></svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-bold text-gray-800">Nueva Carpeta</h3>
                        <p class="text-xs text-gray-400">en {{ $grade->name }}</p>
                    </div>
                </div>
                <form method="POST" action="{{ route('archivero.storeFolder') }}"
                      @submit="folderModal = false">
                    @csrf
                    <input type="hidden" name="grade_id" value="{{ $grade->id }}">
                    <div class="mb-4">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Nombre de la carpeta</label>
                        <input type="text" name="name" required maxlength="255"
                               class="input-field"
                               placeholder="Ej: Matemáticas">
                    </div>
                    <div class="mb-6">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Descripción <span class="text-gray-400 font-normal">(opcional)</span></label>
                        <textarea name="description" rows="3"
                                  class="input-field"
                                  placeholder="Descripción de la carpeta"></textarea>
                    </div>
                    <div class="flex justify-end gap-3">
                        <button type="button" @click="folderModal = false"
                                class="px-5 py-2.5 text-sm font-medium text-gray-600 hover:text-gray-800 transition-colors rounded-xl hover:bg-gray-100">
                            Cancelar
                        </button>
                        <button type="submit" class="btn-primary !py-2.5 !px-5 text-sm">
                            Crear Carpeta
                        </button>
                    </div>
                </form>
            </div>
        </div>

        {{-- Edit Folder Modal --}}
        <div x-show="editModal" x-transition.opacity class="fixed inset-0 bg-black/40 z-50 overflow-y-auto p-4 flex items-center justify-center backdrop-blur-sm"
             @click.self="editModal = false">
            <div class="bg-white rounded-3xl shadow-2xl w-full max-w-lg p-8 relative">
                <button type="button" @click="editModal = false" class="absolute top-4 right-4 text-gray-300 hover:text-gray-500 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-10 h-10 bg-orange-pastel/10 rounded-2xl flex items-center justify-center">
                        <svg class="w-5 h-5 text-orange-pastel" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-bold text-gray-800">Editar Carpetas</h3>
                        <p class="text-xs text-gray-400" x-text="editId ? 'Modificando: ' + editName : 'Selecciona una carpeta para modificar'"></p>
                    </div>
                </div>

                {{-- Step 1: elegir carpeta --}}
                <div x-show="!editId">
                    <div x-show="folders.length === 0" class="text-center py-8">
                        <p class="text-sm text-gray-400">Este grado aún no tiene carpetas.</p>
                    </div>
                    <div x-show="folders.length > 0" class="max-h-64 overflow-y-auto space-y-2 mb-2 pr-1">
                        <template x-for="f in folders" :key="f.id">
                            <button type="button" @click="editId = f.id; editName = f.name; editDesc = f.desc"
                                    class="w-full text-left px-4 py-3 rounded-xl border border-gray-200 hover:border-orange-pastel hover:bg-orange-pastel/5 transition-all flex items-center justify-between group">
                                <span class="font-medium text-gray-700 group-hover:text-gray-900" x-text="f.name"></span>
                                <svg class="w-4 h-4 text-gray-300 group-hover:text-orange-pastel shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                            </button>
                        </template>
                    </div>
                </div>

                {{-- Step 2: escribir el nuevo nombre --}}
                <div x-show="editId">
                    <form method="POST" :action="'{{ url('archivero/carpeta') }}' + '/' + editId"
                          @submit="editModal = false">
                        @csrf
                        @method('PUT')
                        <div class="mb-4">
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Nuevo nombre de la carpeta</label>
                            <input type="text" name="name" x-model="editName" required maxlength="255"
                                   class="input-field"
                                   placeholder="Nuevo nombre">
                        </div>
                        <div class="mb-6">
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Descripción <span class="text-gray-400 font-normal">(opcional)</span></label>
                            <textarea name="description" x-model="editDesc" rows="3"
                                      class="input-field"
                                      placeholder="Descripción de la carpeta"></textarea>
                        </div>
                        <div class="flex justify-between gap-3">
                            <button type="button" @click="editId = null"
                                    class="px-4 py-2.5 text-sm font-medium text-gray-500 hover:text-gray-700 transition-colors rounded-xl hover:bg-gray-100 flex items-center gap-1.5">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                                Volver a la lista
                            </button>
                            <button type="submit" class="btn-primary !py-2.5 !px-5 text-sm">
                                Guardar Cambios
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection