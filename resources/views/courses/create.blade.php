@extends('layouts.archivero')

@section('title', 'Nuevo Curso')

@section('content')
    <div class="max-w-3xl mx-auto">
        <div class="flex items-center mb-6">
            <a href="{{ route('courses.index') }}" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300 mr-4">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
            </a>
            <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Nuevo Curso</h1>
        </div>

        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-8">
            <form method="POST" action="{{ route('courses.store') }}" class="space-y-6">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Nombre <span class="text-red-500">*</span></label>
                        <input type="text" name="nombre" value="{{ old('nombre') }}" required maxlength="255"
                               class="w-full rounded-lg border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white px-4 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                               placeholder="Ej: Matemáticas I">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Grado <span class="text-red-500">*</span></label>
                        <select name="grade_id" required
                                class="w-full rounded-lg border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white px-4 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <option value="">Seleccionar grado</option>
                            @foreach ($grades as $grade)
                                <option value="{{ $grade->id }}" {{ old('grade_id') == $grade->id ? 'selected' : '' }}>{{ $grade->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Descripción</label>
                    <textarea name="descripcion" rows="3"
                              class="w-full rounded-lg border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white px-4 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500">{{ old('descripcion') }}</textarea>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Docente <span class="text-red-500">*</span></label>
                        <select name="teacher_id" required
                                class="w-full rounded-lg border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white px-4 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <option value="">Seleccionar docente</option>
                            @foreach ($teachers as $teacher)
                                <option value="{{ $teacher->id }}" {{ old('teacher_id') == $teacher->id ? 'selected' : '' }}>{{ $teacher->nombre_completo }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Estado <span class="text-red-500">*</span></label>
                        <select name="estado" required
                                class="w-full rounded-lg border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white px-4 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <option value="Activo" {{ old('estado') == 'Activo' ? 'selected' : '' }}>Activo</option>
                            <option value="Inactivo" {{ old('estado') == 'Inactivo' ? 'selected' : '' }}>Inactivo</option>
                        </select>
                    </div>
                </div>

                <hr class="border-gray-200 dark:border-gray-700">

                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Horario</h3>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Día de la semana</label>
                        <select name="dia_semana"
                                class="w-full rounded-lg border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white px-4 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <option value="">Seleccionar</option>
                            @foreach (['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'] as $dia)
                                <option value="{{ $dia }}" {{ old('dia_semana') == $dia ? 'selected' : '' }}>{{ $dia }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Hora de inicio</label>
                        <input type="time" name="hora_inicio" value="{{ old('hora_inicio') }}"
                               class="w-full rounded-lg border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white px-4 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Hora de fin</label>
                        <input type="time" name="hora_fin" value="{{ old('hora_fin') }}"
                               class="w-full rounded-lg border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white px-4 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>
                </div>

                <div class="flex items-center justify-between pt-4 border-t border-gray-200 dark:border-gray-700">
                    <a href="{{ route('courses.index') }}" class="text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white transition">Cancelar</a>
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg font-medium transition">Guardar Curso</button>
                </div>
            </form>
        </div>
    </div>
@endsection
