@extends('layouts.archivero')

@section('title', 'Buscar Archivos')

@section('content')
    <div class="mb-8">
        <h1 class="text-2xl sm:text-3xl font-extrabold text-gray-800">Buscar Archivos</h1>
        <p class="text-sm text-gray-400 mt-1">Encuentra archivos por nombre, grado o materia</p>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 sm:p-8 mb-8">
        <form method="GET" action="{{ route('archivero.search') }}" class="space-y-4">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <label for="search" class="block text-sm font-semibold text-gray-700 mb-2">Buscar por nombre</label>
                    <div class="relative">
                        <svg class="absolute left-3.5 top-1/2 -translate-y-1/2 w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                        <input type="text" name="search" id="search" value="{{ request('search') }}"
                               class="input-field pl-11"
                               placeholder="Buscar archivos...">
                    </div>
                </div>
                <div>
                    <label for="grade_id" class="block text-sm font-semibold text-gray-700 mb-2">Filtrar por grado</label>
                    <select name="grade_id" id="grade_id"
                            class="input-field appearance-none bg-[url('data:image/svg+xml;charset=UTF-8,%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20width%3D%2220%22%20height%3D%2220%22%20fill%3D%22none%22%20stroke%3D%22%239ca3af%22%20viewBox%3D%220%200%2024%2024%22%3E%3Cpath%20stroke-linecap%3D%22round%22%20stroke-linejoin%3D%22round%22%20stroke-width%3D%222%22%20d%3D%22M19%209l-7%207-7-7%22%2F%3E%3C%2Fsvg%3E')] bg-[length:20px] bg-[right_12px_center] bg-no-repeat pr-10">
                        <option value="">Todos los grados</option>
                        @foreach ($grades as $g)
                            <option value="{{ $g->id }}" {{ request('grade_id') == $g->id ? 'selected' : '' }}>{{ $g->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="folder_id" class="block text-sm font-semibold text-gray-700 mb-2">Filtrar por materia</label>
                    <select name="folder_id" id="folder_id"
                            class="input-field appearance-none bg-[url('data:image/svg+xml;charset=UTF-8,%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20width%3D%2220%22%20height%3D%2220%22%20fill%3D%22none%22%20stroke%3D%22%239ca3af%22%20viewBox%3D%220%200%2024%2024%22%3E%3Cpath%20stroke-linecap%3D%22round%22%20stroke-linejoin%3D%22round%22%20stroke-width%3D%222%22%20d%3D%22M19%209l-7%207-7-7%22%2F%3E%3C%2Fsvg%3E')] bg-[length:20px] bg-[right_12px_center] bg-no-repeat pr-10">
                        <option value="">Todas las materias</option>
                        @foreach ($folders as $f)
                            <option value="{{ $f->id }}" {{ request('folder_id') == $f->id ? 'selected' : '' }}>{{ $f->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="flex justify-end pt-2">
                <button type="submit" class="btn-primary !py-2.5 !px-6 text-sm flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                    Buscar
                </button>
            </div>
        </form>
    </div>

    @if (request()->hasAny(['search', 'grade_id', 'folder_id']))
        <div class="mb-4">
            <p class="text-sm text-gray-500 flex items-center gap-1.5">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                Resultados: <span class="font-semibold text-gray-700">{{ $archives->total() }} archivos encontrados</span>
            </p>
        </div>

        @if ($archives->count() > 0)
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="bg-educlub text-white text-sm">
                                <th class="text-left py-3.5 px-6 font-semibold">Archivo</th>
                                <th class="text-left py-3.5 px-6 font-semibold">Grado</th>
                                <th class="text-left py-3.5 px-6 font-semibold">Materia</th>
                                <th class="text-left py-3.5 px-6 font-semibold">Tamaño</th>
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
                                                    $icon = match (true) {
                                                        str_contains($archive->file_mime, 'pdf') => 'bg-red-50 text-red-500',
                                                        str_contains($archive->file_mime, 'word') || str_contains($archive->file_mime, 'document') => 'bg-blue-50 text-educlub',
                                                        str_contains($archive->file_mime, 'sheet') || str_contains($archive->file_mime, 'excel') => 'bg-green-50 text-green-pastel',
                                                        str_contains($archive->file_mime, 'presentation') || str_contains($archive->file_mime, 'powerpoint') => 'bg-orange-50 text-orange-pastel',
                                                        str_contains($archive->file_mime, 'image') => 'bg-purple-50 text-purple-500',
                                                        str_contains($archive->file_mime, 'video') => 'bg-pink-50 text-pink-pastel',
                                                        str_contains($archive->file_mime, 'zip') || str_contains($archive->file_mime, 'rar') => 'bg-yellow-50 text-yellow-600',
                                                        default => 'bg-gray-50 text-gray-400',
                                                    };
                                                @endphp
                                                {{ $icon }}">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                                                </svg>
                                            </div>
                                            <div class="min-w-0">
                                                <p class="text-sm font-semibold text-gray-800 truncate">{{ $archive->title }}</p>
                                                <p class="text-xs text-gray-400 truncate">{{ $archive->original_name }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="py-4 px-6 text-sm text-gray-500">{{ $archive->folder->grade->name }}</td>
                                    <td class="py-4 px-6">
                                        <span class="inline-flex items-center gap-1 px-2.5 py-1 bg-green-pastel/10 text-green-pastel text-xs font-medium rounded-lg">
                                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"/></svg>
                                            {{ $archive->folder->name }}
                                        </span>
                                    </td>
                                    <td class="py-4 px-6 text-sm text-gray-500 whitespace-nowrap">
                                        @php
                                            $size = $archive->file_size;
                                            $formatted = $size >= 1073741824 ? number_format($size / 1073741824, 2) . ' GB' : ($size >= 1048576 ? number_format($size / 1048576, 2) . ' MB' : ($size >= 1024 ? number_format($size / 1024, 2) . ' KB' : $size . ' B'));
                                        @endphp
                                        {{ $formatted }}
                                    </td>
                                    <td class="py-4 px-6 text-sm text-gray-500 whitespace-nowrap">{{ $archive->created_at->format('d/m/Y') }}</td>
                                    <td class="py-4 px-6 text-right whitespace-nowrap">
                                        <div class="flex items-center justify-end gap-1">
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
                                            <a href="{{ route('archivero.folder', $archive->folder) }}"
                                               class="p-2 text-gray-300 hover:text-green-pastel hover:bg-green-50 rounded-xl transition-all" title="Ir a la carpeta">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"/>
                                                </svg>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="mt-6">
                {{ $archives->appends(request()->query())->links() }}
            </div>
        @else
            <div class="text-center py-16">
                <div class="w-20 h-20 bg-gray-100 rounded-3xl flex items-center justify-center mx-auto mb-4">
                    <svg class="w-10 h-10 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-gray-700 mb-1">Sin resultados</h3>
                <p class="text-sm text-gray-400">No se encontraron archivos con los criterios de búsqueda.</p>
            </div>
        @endif
    @else
        <div class="text-center py-20">
            <div class="w-24 h-24 bg-gray-100 rounded-3xl flex items-center justify-center mx-auto mb-5">
                <svg class="w-12 h-12 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
            </div>
            <h3 class="text-xl font-bold text-gray-700 mb-2">Busca archivos en el archivero</h3>
            <p class="text-sm text-gray-400">Utiliza los filtros de arriba para encontrar archivos por nombre, grado o materia.</p>
        </div>
    @endif

    <script>
        document.getElementById('grade_id')?.addEventListener('change', function() {
            const gradeId = this.value;
            const folderSelect = document.getElementById('folder_id');
            folderSelect.innerHTML = '<option value="">Cargando...</option>';
            if (gradeId) {
                fetch('{{ route("archivero.foldersByGrade") }}?grade_id=' + gradeId)
                    .then(r => r.json())
                    .then(data => {
                        folderSelect.innerHTML = '<option value="">Todas las materias</option>';
                        data.forEach(f => {
                            folderSelect.innerHTML += '<option value="' + f.id + '">' + f.name + '</option>';
                        });
                    });
            } else {
                folderSelect.innerHTML = '<option value="">Todas las materias</option>';
            }
        });
    </script>
@endsection
