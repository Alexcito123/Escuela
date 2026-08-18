@extends('layouts.archivero')

@section('title', $course->nombre)

@section('content')
    <div class="flex items-center mb-6">
        <a href="{{ route('courses.index') }}" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300 mr-4">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
        </a>
        <h1 class="text-2xl font-bold text-gray-900 dark:text-white">{{ $course->nombre }}</h1>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="lg:col-span-1">
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-6 text-center">
                <div class="w-24 h-24 rounded-full bg-blue-100 dark:bg-blue-900 mx-auto mb-4 flex items-center justify-center">
                    <svg class="w-12 h-12 text-blue-600 dark:text-blue-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                    </svg>
                </div>
                <h2 class="text-xl font-bold text-gray-900 dark:text-white">{{ $course->nombre }}</h2>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">{{ $course->grade->name }}</p>
                <div class="mt-4">
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium {{ $course->estado === 'Activo' ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200' : 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200' }}">
                        {{ $course->estado }}
                    </span>
                </div>
                <div class="mt-6 flex justify-center space-x-3">
                    <a href="{{ route('courses.edit', $course) }}" class="bg-amber-600 hover:bg-amber-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition">Editar</a>
                    <form method="POST" action="{{ route('courses.destroy', $course) }}" onsubmit="return confirm('¿Eliminar este curso?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition">Eliminar</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="lg:col-span-2 space-y-6">
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-6">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Información del Curso</h3>
                <dl class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <dt class="text-sm text-gray-500 dark:text-gray-400">Nombre</dt>
                        <dd class="text-sm font-medium text-gray-900 dark:text-white">{{ $course->nombre }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm text-gray-500 dark:text-gray-400">Grado</dt>
                        <dd class="text-sm font-medium text-gray-900 dark:text-white">{{ $course->grade->name }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm text-gray-500 dark:text-gray-400">Docente asignado</dt>
                        <dd class="text-sm font-medium text-gray-900 dark:text-white">{{ $course->teacher->nombre_completo }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm text-gray-500 dark:text-gray-400">Estado</dt>
                        <dd class="text-sm font-medium text-gray-900 dark:text-white">{{ $course->estado }}</dd>
                    </div>
                    <div class="md:col-span-2">
                        <dt class="text-sm text-gray-500 dark:text-gray-400">Descripción</dt>
                        <dd class="text-sm font-medium text-gray-900 dark:text-white">{{ $course->descripcion ?? '—' }}</dd>
                    </div>
                </dl>
            </div>

            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-6">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Horario</h3>
                @if ($course->dia_semana && $course->hora_inicio)
                    <dl class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <dt class="text-sm text-gray-500 dark:text-gray-400">Día</dt>
                            <dd class="text-sm font-medium text-gray-900 dark:text-white">{{ $course->dia_semana }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm text-gray-500 dark:text-gray-400">Hora de inicio</dt>
                            <dd class="text-sm font-medium text-gray-900 dark:text-white">{{ \Carbon\Carbon::parse($course->hora_inicio)->format('H:i') }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm text-gray-500 dark:text-gray-400">Hora de fin</dt>
                            <dd class="text-sm font-medium text-gray-900 dark:text-white">{{ \Carbon\Carbon::parse($course->hora_fin)->format('H:i') }}</dd>
                        </div>
                    </dl>
                @else
                    <p class="text-sm text-gray-500 dark:text-gray-400">No se ha asignado un horario.</p>
                @endif
            </div>

            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-6">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Docente</h3>
                <div class="flex items-center space-x-4">
                    <div class="w-14 h-14 rounded-full bg-gray-200 dark:bg-gray-600 flex items-center justify-center overflow-hidden flex-shrink-0">
                        @if ($course->teacher->fotografia)
                            <img src="{{ asset('storage/' . $course->teacher->fotografia) }}" alt="" class="w-full h-full object-cover">
                        @else
                            <svg class="w-7 h-7 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        @endif
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-900 dark:text-white">{{ $course->teacher->nombre_completo }}</p>
                        <p class="text-xs text-gray-500 dark:text-gray-400">{{ $course->teacher->especialidad }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
