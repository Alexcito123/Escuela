@extends('layouts.archivero')

@section('title', 'Cursos')

@section('content')
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Cursos</h1>
            <p class="text-sm text-gray-500 mt-1">{{ $courses->total() }} registros</p>
        </div>
        <a href="{{ route('courses.create') }}"
           class="bg-educlub hover:bg-educlub text-white px-4 py-2 rounded-xl text-sm font-medium transition flex items-center gap-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>
            <span>Nuevo Curso</span>
        </a>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-4 mb-6">
        <form method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div>
                <input type="text" name="search" value="{{ request('search') }}"
                       class="w-full rounded-xl border border-gray-200 px-4 py-2 text-sm focus:ring-2 focus:ring-educlub/30 focus:border-educlub"
                       placeholder="Buscar por nombre...">
            </div>
            <div>
                <select name="grade_id"
                        class="w-full rounded-xl border border-gray-200 px-4 py-2 text-sm focus:ring-2 focus:ring-educlub/30 focus:border-educlub">
                    <option value="">Todos los grados</option>
                    @foreach ($grades as $grade)
                        <option value="{{ $grade->id }}" {{ request('grade_id') == $grade->id ? 'selected' : '' }}>{{ $grade->name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <select name="teacher_id"
                        class="w-full rounded-xl border border-gray-200 px-4 py-2 text-sm focus:ring-2 focus:ring-educlub/30 focus:border-educlub">
                    <option value="">Todos los docentes</option>
                    @foreach ($teachers as $teacher)
                        <option value="{{ $teacher->id }}" {{ request('teacher_id') == $teacher->id ? 'selected' : '' }}>{{ $teacher->nombre_completo }}</option>
                    @endforeach
                </select>
            </div>
            <div class="flex gap-2">
                <button type="submit" class="bg-educlub hover:bg-educlub text-white px-4 py-2 rounded-xl text-sm font-medium transition flex-1">Filtrar</button>
                <a href="{{ route('courses.index') }}" class="bg-gray-100 hover:bg-gray-200 text-gray-700 px-4 py-2 rounded-xl text-sm font-medium transition">Limpiar</a>
            </div>
        </form>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-educlub text-white">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-semibold uppercase">Curso</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold uppercase">Grado</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold uppercase">Docente</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold uppercase">Horario</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold uppercase">Estado</th>
                        <th class="px-6 py-3 text-right text-xs font-semibold uppercase">Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse ($courses as $course)
                        <tr class="hover:bg-educlub/5 transition">
                            <td class="px-6 py-4">
                                <p class="text-sm font-semibold text-gray-900">{{ $course->nombre }}</p>
                                @if ($course->descripcion)
                                    <p class="text-xs text-gray-500 mt-0.5 truncate max-w-xs">{{ $course->descripcion }}</p>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-500">{{ $course->grade->name }}</td>
                            <td class="px-6 py-4 text-sm text-gray-500">{{ $course->teacher->nombre_completo }}</td>
                            <td class="px-6 py-4 text-sm text-gray-500">
                                @if ($course->dia_semana && $course->hora_inicio)
                                    {{ $course->dia_semana }} {{ \Carbon\Carbon::parse($course->hora_inicio)->format('H:i') }}-{{ \Carbon\Carbon::parse($course->hora_fin)->format('H:i') }}
                                @else
                                    —
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $course->estado === 'Activo' ? 'bg-green-pastel/10 text-green-pastel' : 'bg-red-100 text-red-800' }}">
                                    {{ $course->estado }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-right whitespace-nowrap">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('courses.show', $course) }}" class="text-gray-300 hover:text-educlub transition" title="Ver">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                    </a>
                                    <a href="{{ route('courses.edit', $course) }}" class="text-gray-300 hover:text-orange-pastel transition" title="Editar">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                    </a>
                                    <form method="POST" action="{{ route('courses.destroy', $course) }}" onsubmit="return confirm('¿Eliminar este curso?')" class="inline">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="text-gray-300 hover:text-red-500 transition" title="Eliminar">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center text-gray-500">
                                <svg class="w-16 h-16 mx-auto mb-4 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                </svg>
                                <p>No se encontraron cursos.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-6">
        {{ $courses->appends(request()->query())->links() }}
    </div>
@endsection
