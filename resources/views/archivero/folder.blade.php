@extends('layouts.archivero')

@section('title', $folder->name)

@section('content')
    @include('archivero.partials.breadcrumb')

    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-900 dark:text-white">{{ $folder->name }}</h1>
            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">{{ $folder->grade->name }} · {{ $archives->total() }} archivos</p>
        </div>
        <div class="flex space-x-2">
            <form method="POST" action="{{ route('archivero.destroyFolder', $folder) }}"
                  onsubmit="return confirm('¿Eliminar esta carpeta y todos sus archivos?')">
                @csrf @method('DELETE')
                <button type="submit" class="text-red-600 hover:text-red-700 text-sm font-medium px-3 py-2 rounded-lg border border-red-200 dark:border-red-800 hover:bg-red-50 dark:hover:bg-red-900 transition">
                    Eliminar Carpeta
                </button>
            </form>
            <a href="{{ route('archivero.create', $folder) }}"
               class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition flex items-center space-x-1">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                <span>Subir Archivo</span>
            </a>
        </div>
    </div>

    @if ($archives->count() > 0)
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                    <thead class="bg-gray-50 dark:bg-gray-900">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Archivo</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Tamaño</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Subido por</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Fecha</th>
                            <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                        @foreach ($archives as $archive)
                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-750 transition">
                                <td class="px-6 py-4">
                                    <div class="flex items-center space-x-3">
                                        <div class="flex-shrink-0 w-10 h-10 bg-gray-100 dark:bg-gray-700 rounded-lg flex items-center justify-center">
                                            @php
                                                $icon = match (true) {
                                                    str_contains($archive->file_mime, 'pdf') => 'blue',
                                                    str_contains($archive->file_mime, 'word') || str_contains($archive->file_mime, 'document') => 'blue',
                                                    str_contains($archive->file_mime, 'sheet') || str_contains($archive->file_mime, 'excel') => 'green',
                                                    str_contains($archive->file_mime, 'presentation') || str_contains($archive->file_mime, 'powerpoint') => 'orange',
                                                    str_contains($archive->file_mime, 'image') => 'purple',
                                                    str_contains($archive->file_mime, 'video') => 'red',
                                                    str_contains($archive->file_mime, 'zip') || str_contains($archive->file_mime, 'rar') => 'yellow',
                                                    default => 'gray',
                                                };
                                            @endphp
                                            <svg class="w-5 h-5 text-{{ $icon }}-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                                            </svg>
                                        </div>
                                        <div class="min-w-0 flex-1">
                                            <p class="text-sm font-medium text-gray-900 dark:text-white truncate" title="{{ $archive->original_name }}">
                                                {{ $archive->title }}
                                            </p>
                                            <p class="text-xs text-gray-500 dark:text-gray-400 truncate">{{ $archive->original_name }}</p>
                                            @if ($archive->description)
                                                <p class="text-xs text-gray-400 dark:text-gray-500 mt-1 truncate">{{ $archive->description }}</p>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-500 dark:text-gray-400 whitespace-nowrap">
                                    @php
                                        $size = $archive->file_size;
                                        if ($size >= 1073741824) {
                                            $formatted = number_format($size / 1073741824, 2) . ' GB';
                                        } elseif ($size >= 1048576) {
                                            $formatted = number_format($size / 1048576, 2) . ' MB';
                                        } elseif ($size >= 1024) {
                                            $formatted = number_format($size / 1024, 2) . ' KB';
                                        } else {
                                            $formatted = $size . ' B';
                                        }
                                    @endphp
                                    {{ $formatted }}
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-500 dark:text-gray-400 whitespace-nowrap">
                                    {{ $archive->user->name }}
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-500 dark:text-gray-400 whitespace-nowrap">
                                    {{ $archive->created_at->format('d/m/Y H:i') }}
                                </td>
                                <td class="px-6 py-4 text-right whitespace-nowrap">
                                    <div class="flex items-center justify-end space-x-2">
                                        <a href="{{ route('archivero.download', $archive) }}"
                                           class="text-gray-400 hover:text-blue-600 dark:hover:text-blue-400 transition" title="Descargar">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                            </svg>
                                        </a>
                                        <a href="{{ route('archivero.edit', $archive) }}"
                                           class="text-gray-400 hover:text-amber-600 dark:hover:text-amber-400 transition" title="Editar">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                        </a>
                                        <form method="POST" action="{{ route('archivero.destroy', $archive) }}"
                                              onsubmit="return confirm('¿Eliminar este archivo?')" class="inline">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="text-gray-400 hover:text-red-600 dark:hover:text-red-400 transition" title="Eliminar">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
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
        <div class="text-center py-16">
            <svg class="w-20 h-20 mx-auto mb-4 text-gray-300 dark:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
            </svg>
            <h3 class="text-lg font-medium text-gray-700 dark:text-gray-300 mb-2">No hay archivos</h3>
            <p class="text-gray-500 dark:text-gray-400 mb-6">Esta carpeta está vacía. Sube el primer archivo.</p>
            <a href="{{ route('archivero.create', $folder) }}"
               class="inline-flex items-center space-x-1 bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg font-medium transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                <span>Subir Archivo</span>
            </a>
        </div>
    @endif
@endsection
