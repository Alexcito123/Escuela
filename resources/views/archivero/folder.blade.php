@extends('layouts.archivero')

@section('title', $folder->name)

@section('content')
    @include('archivero.partials.breadcrumb')

    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 mb-8">
        <div>
            <h1 class="text-2xl sm:text-3xl font-extrabold text-gray-800 truncate max-w-md">{{ $folder->name }}</h1>
            <p class="text-sm text-gray-400 mt-1 flex items-center gap-1.5">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"/></svg>
                {{ $folder->grade->name }}
                <span class="text-gray-300">·</span>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>
                {{ $archives->total() }} archivos
            </p>
        </div>
        <div class="flex items-center gap-2">
            <form method="POST" action="{{ route('archivero.destroyFolder', $folder) }}"
                  onsubmit="return confirm('¿Eliminar esta carpeta y todos sus archivos? Esta acción no se puede deshacer.')">
                @csrf @method('DELETE')
                <button type="submit" class="px-4 py-2.5 text-sm font-medium text-red-500 hover:text-red-600 bg-white border border-red-200 rounded-xl hover:bg-red-50 transition-all flex items-center gap-1.5">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                    Eliminar
                </button>
            </form>
            <a href="{{ route('archivero.create', $folder) }}"
               class="btn-primary !py-2.5 !px-5 text-sm flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Subir Archivo
            </a>
        </div>
    </div>

    @if ($archives->count() > 0)
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="bg-educlub text-white text-sm">
                            <th class="text-left py-3.5 px-6 font-semibold">Archivo</th>
                            <th class="text-left py-3.5 px-6 font-semibold">Tamaño</th>
                            <th class="text-left py-3.5 px-6 font-semibold">Subido por</th>
                            <th class="text-left py-3.5 px-6 font-semibold">Fecha</th>
                            <th class="text-right py-3.5 px-6 font-semibold">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach ($archives as $archive)
                            <tr class="bg-white hover:bg-educlub/5 transition-colors">
                                <td class="py-4 px-6">
                                    <div class="flex items-center gap-3">
                                        <div class="shrink-0 w-10 h-10 rounded-xl flex items-center justify-center
                                            @php
                                                $mime = $archive->file_mime[0] ?? '';
                                                $icon = match (true) {
                                                    str_contains($mime, 'pdf') => 'bg-red-50 text-red-500',
                                                    str_contains($mime, 'word') || str_contains($mime, 'document') => 'bg-blue-50 text-educlub',
                                                    str_contains($mime, 'sheet') || str_contains($mime, 'excel') => 'bg-green-50 text-green-pastel',
                                                    str_contains($mime, 'presentation') || str_contains($mime, 'powerpoint') => 'bg-orange-50 text-orange-pastel',
                                                    str_contains($mime, 'image') => 'bg-purple-50 text-purple-500',
                                                    str_contains($mime, 'video') => 'bg-pink-50 text-pink-pastel',
                                                    str_contains($mime, 'zip') || str_contains($mime, 'rar') => 'bg-yellow-50 text-yellow-600',
                                                    default => 'bg-gray-50 text-gray-400',
                                                };
                                            @endphp
                                            {{ $icon }}">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                                            </svg>
                                        </div>
                                        <div class="min-w-0 flex-1">
                                            <p class="text-sm font-semibold text-gray-800 truncate" title="{{ $archive->title }}">
                                                {{ $archive->title }}
                                            </p>
                                            <p class="text-xs text-gray-400 truncate">
                                                {{ count($archive->files) }} archivo(s): {{ implode(', ', array_slice($archive->original_name, 0, 2)) }}{{ count($archive->files) > 2 ? ', ...' : '' }}
                                            </p>
                                            @if ($archive->description)
                                                <p class="text-xs text-gray-300 mt-0.5 truncate">{{ $archive->description }}</p>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                                <td class="py-4 px-6 text-sm text-gray-500 whitespace-nowrap">
                                    @php
                                        $size = $archive->total_size;
                                        $formatted = $size >= 1073741824 ? number_format($size / 1073741824, 2) . ' GB' : ($size >= 1048576 ? number_format($size / 1048576, 2) . ' MB' : ($size >= 1024 ? number_format($size / 1024, 2) . ' KB' : $size . ' B'));
                                    @endphp
                                    {{ $formatted }}
                                </td>
                                <td class="py-4 px-6 text-sm text-gray-500 whitespace-nowrap">
                                    <div class="flex items-center gap-2">
                                        <div class="w-6 h-6 rounded-full bg-educlub/10 flex items-center justify-center">
                                            <svg class="w-3.5 h-3.5 text-educlub" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                                        </div>
                                        {{ $archive->user->name }}
                                    </div>
                                </td>
                                <td class="py-4 px-6 text-sm text-gray-500 whitespace-nowrap">
                                    {{ $archive->created_at->format('d/m/Y H:i') }}
                                </td>
                                <td class="py-4 px-6 text-right whitespace-nowrap">
                                    <div class="flex items-center justify-end gap-1">
                                        <a href="{{ route('archivero.print', $archive) }}"
                                           target="_blank"
                                           class="p-2 text-gray-300 hover:text-purple-500 hover:bg-purple-50 rounded-xl transition-all" title="Imprimir">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4H7v4a2 2 0 002 2zm3-9V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v3h4z"/>
                                            </svg>
                                        </a>
                                        <a href="{{ route('archivero.download', $archive) }}"
                                           class="p-2 text-gray-300 hover:text-educlub hover:bg-educlub/5 rounded-xl transition-all" title="Descargar">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                                            </svg>
                                        </a>
                                        <a href="{{ route('archivero.edit', $archive) }}"
                                           class="p-2 text-gray-300 hover:text-orange-pastel hover:bg-orange-50 rounded-xl transition-all" title="Editar">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                            </svg>
                                        </a>
                                        <form method="POST" action="{{ route('archivero.destroy', $archive) }}"
                                              onsubmit="return confirm('¿Eliminar este archivo?')" class="inline">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="p-2 text-gray-300 hover:text-red-500 hover:bg-red-50 rounded-xl transition-all" title="Eliminar">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="mt-6">
            {{ $archives->links() }}
        </div>
    @else
        <div class="text-center py-20">
            <div class="w-24 h-24 bg-gray-100 rounded-3xl flex items-center justify-center mx-auto mb-5">
                <svg class="w-12 h-12 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
            </div>
            <h3 class="text-xl font-bold text-gray-700 mb-2">No hay archivos</h3>
            <p class="text-gray-400 mb-8">Esta carpeta está vacía. Sube el primer archivo.</p>
            <a href="{{ route('archivero.create', $folder) }}"
               class="btn-primary !py-3 !px-8">
                <span class="flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    Subir Archivo
                </span>
            </a>
        </div>
    @endif
@endsection
