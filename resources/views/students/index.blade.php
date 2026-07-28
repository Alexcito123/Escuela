@extends('layouts.archivero')

@section('title', 'Alumnos')

@section('content')
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Alumnos</h1>
            <p class="text-sm text-gray-500 mt-1">{{ $students->total() }} registros</p>
        </div>
        <a href="{{ route('students.create') }}"
           class="bg-educlub hover:bg-educlub text-white px-4 py-2 rounded-xl text-sm font-medium transition flex items-center gap-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>
            <span>Nuevo Alumno</span>
        </a>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-4 mb-6">
        <form method="GET" action="{{ route('students.index') }}" class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div>
                <input type="text" name="search" value="{{ request('search') }}"
                       class="w-full rounded-xl border border-gray-200 px-4 py-2 text-sm focus:ring-2 focus:ring-educlub/30 focus:border-educlub"
                       placeholder="Buscar por nombre o CURP...">
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
                <select name="estado"
                        class="w-full rounded-xl border border-gray-200 px-4 py-2 text-sm focus:ring-2 focus:ring-educlub/30 focus:border-educlub">
                    <option value="">Todos los estados</option>
                    <option value="Activo" {{ request('estado') == 'Activo' ? 'selected' : '' }}>Activo</option>
                    <option value="Inactivo" {{ request('estado') == 'Inactivo' ? 'selected' : '' }}>Inactivo</option>
                </select>
            </div>
            <div class="flex gap-2">
                <button type="submit" class="bg-educlub hover:bg-educlub text-white px-4 py-2 rounded-xl text-sm font-medium transition flex-1">Filtrar</button>
                <a href="{{ route('students.index') }}" class="bg-gray-100 hover:bg-gray-200 text-gray-700 px-4 py-2 rounded-xl text-sm font-medium transition">Limpiar</a>
            </div>
        </form>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4 mb-6">
        @foreach ($grades as $grade)
            @php
                $count = $grade->students()->count();
                $selected = request('grade_id') == $grade->id;
            @endphp
            <a href="{{ route('students.index', ['grade_id' => $grade->id] + request()->except('grade_id', 'page')) }}"
               class="relative bg-white rounded-xl shadow-sm border {{ $selected ? 'border-educlub ring-2 ring-educlub/20' : 'border-gray-100' }} p-4 transition-all hover:shadow-md hover:-translate-y-0.5">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl {{ $selected ? 'bg-educlub/10' : 'bg-gray-100' }} flex items-center justify-center shrink-0">
                        <svg class="w-5 h-5 {{ $selected ? 'text-educlub' : 'text-gray-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                    </div>
                    <div class="min-w-0">
                        <p class="text-sm font-semibold text-gray-900 truncate">{{ $grade->name }}</p>
                        <p class="text-xs text-gray-500">{{ $count }} alumnos</p>
                    </div>
                </div>
            </a>
        @endforeach
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-educlub text-white">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-semibold uppercase">Alumno</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold uppercase">Grado</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold uppercase">Tutor</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold uppercase">Teléfono</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold uppercase">Estado</th>
                        <th class="px-6 py-3 text-right text-xs font-semibold uppercase">Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse ($students as $student)
                        <tr class="hover:bg-educlub/5 transition">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-full bg-gray-100 flex items-center justify-center shrink-0 overflow-hidden">
                                        @if ($student->fotografia)
                                            <img src="{{ asset('storage/' . $student->fotografia) }}" alt="" class="w-full h-full object-cover">
                                        @else
                                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                            </svg>
                                        @endif
                                    </div>
                                    <div class="min-w-0">
                                        <p class="text-sm font-semibold text-gray-900 truncate">{{ $student->nombre_completo }}</p>
                                        <p class="text-xs text-gray-500">{{ $student->curp ?? 'Sin CURP' }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-500">{{ $student->grade->name }} · {{ $student->grupo }}</td>
                            <td class="px-6 py-4 text-sm text-gray-500">
                                <p class="truncate max-w-[150px]">{{ $student->nombre_tutor }}</p>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-500">{{ $student->telefono }}</td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $student->estado === 'Activo' ? 'bg-green-pastel/10 text-green-pastel' : 'bg-red-100 text-red-800' }}">
                                    {{ $student->estado }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-right whitespace-nowrap">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('students.show', $student) }}" class="text-gray-300 hover:text-educlub transition" title="Ver">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                    </a>
                                    <a href="{{ route('students.edit', $student) }}" class="text-gray-300 hover:text-orange-pastel transition" title="Editar">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                    </a>
                                    <form method="POST" action="{{ route('students.destroy', $student) }}" onsubmit="return confirm('¿Eliminar este alumno?')" class="inline">
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
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                <p>No se encontraron alumnos.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-6">
        {{ $students->appends(request()->query())->links() }}
    </div>
@endsection
