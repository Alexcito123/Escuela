@extends('layouts.archivero')

@section('title', $grade->name)

@section('content')
    @include('archivero.partials.breadcrumb')

    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 mb-8">
        <div>
            <h1 class="text-2xl sm:text-3xl font-extrabold text-gray-800">{{ $grade->name }}</h1>
            <p class="text-sm text-gray-400 mt-1">{{ $folders->count() }} carpetas disponibles</p>
        </div>
        <button onclick="document.getElementById('createFolderModal').classList.remove('hidden')"
                class="btn-primary !py-2.5 !px-5 text-sm flex items-center gap-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            Nueva Carpeta
        </button>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
        @forelse ($folders as $folder)
            <a href="{{ route('archivero.folder', $folder) }}"
               class="group relative bg-white rounded-2xl shadow-sm hover:shadow-lg border border-gray-100 p-6 transition-all duration-300 hover:-translate-y-1 hover:border-green-pastel/30 overflow-hidden">
                <div class="absolute top-0 right-0 w-24 h-24 bg-green-pastel/10 rounded-full -translate-y-1/2 translate-x-1/2 group-hover:scale-150 transition-transform duration-500"></div>
                <div class="relative flex items-start gap-4">
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
        @empty
            <div class="col-span-full text-center py-16">
                <div class="w-20 h-20 bg-gray-100 rounded-3xl flex items-center justify-center mx-auto mb-4">
                    <svg class="w-10 h-10 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"/>
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-gray-700 mb-1">No hay carpetas</h3>
                <p class="text-sm text-gray-400 mb-6">Este grado aún no tiene carpetas. Crea la primera.</p>
                <button onclick="document.getElementById('createFolderModal').classList.remove('hidden')"
                        class="btn-primary !py-2.5 !px-6 text-sm">
                    Crear Primera Carpeta
                </button>
            </div>
        @endforelse
    </div>

    {{-- Create Folder Modal --}}
    <div id="createFolderModal" class="fixed inset-0 bg-black/40 z-50 hidden flex items-center justify-center p-4 backdrop-blur-sm" x-data>
        <div class="bg-white rounded-3xl shadow-2xl w-full max-w-md p-8 relative" @click.away="document.getElementById('createFolderModal').classList.add('hidden')">
            <button onclick="document.getElementById('createFolderModal').classList.add('hidden')" class="absolute top-4 right-4 text-gray-300 hover:text-gray-500 transition-colors">
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
            <form method="POST" action="{{ route('archivero.storeFolder') }}">
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
                    <button type="button" onclick="document.getElementById('createFolderModal').classList.add('hidden')"
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
@endsection
