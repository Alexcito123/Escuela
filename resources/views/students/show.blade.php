@extends('layouts.archivero')

@section('title', $student->nombre_completo)

@section('content')
    <div class="flex items-center mb-6">
        <a href="{{ route('students.index') }}" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300 mr-4">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
        </a>
        <h1 class="text-2xl font-bold text-gray-900 dark:text-white">{{ $student->nombre_completo }}</h1>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="lg:col-span-1">
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-6 text-center">
                <div class="w-32 h-32 rounded-full bg-gray-200 dark:bg-gray-600 mx-auto mb-4 flex items-center justify-center overflow-hidden">
                    @if ($student->fotografia)
                        <img src="{{ asset('storage/' . $student->fotografia) }}" alt="" class="w-full h-full object-cover">
                    @else
                        <svg class="w-12 h-12 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                    @endif
                </div>
                <h2 class="text-xl font-bold text-gray-900 dark:text-white">{{ $student->nombre_completo }}</h2>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">{{ $student->grade->name }} · Grupo {{ $student->grupo }}</p>
                <div class="mt-4">
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium {{ $student->estado === 'Activo' ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200' : 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200' }}">
                        {{ $student->estado }}
                    </span>
                </div>
                <div class="mt-6 flex justify-center space-x-3">
                    <a href="{{ route('students.edit', $student) }}" class="bg-amber-600 hover:bg-amber-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition">
                        Editar
                    </a>
                    <form method="POST" action="{{ route('students.destroy', $student) }}" onsubmit="return confirm('¿Eliminar este alumno?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition">
                            Eliminar
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <div class="lg:col-span-2 space-y-6">
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-6">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Información Personal</h3>
                <dl class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <dt class="text-sm text-gray-500 dark:text-gray-400">Nombre</dt>
                        <dd class="text-sm font-medium text-gray-900 dark:text-white">{{ $student->nombre }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm text-gray-500 dark:text-gray-400">Apellido paterno</dt>
                        <dd class="text-sm font-medium text-gray-900 dark:text-white">{{ $student->apellido_paterno }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm text-gray-500 dark:text-gray-400">Apellido materno</dt>
                        <dd class="text-sm font-medium text-gray-900 dark:text-white">{{ $student->apellido_materno }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm text-gray-500 dark:text-gray-400">Fecha de nacimiento</dt>
                        <dd class="text-sm font-medium text-gray-900 dark:text-white">{{ $student->fecha_nacimiento->format('d/m/Y') }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm text-gray-500 dark:text-gray-400">CURP</dt>
                        <dd class="text-sm font-medium text-gray-900 dark:text-white">{{ $student->curp ?? '—' }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm text-gray-500 dark:text-gray-400">Sexo</dt>
                        <dd class="text-sm font-medium text-gray-900 dark:text-white">{{ $student->sexo }}</dd>
                    </div>
                    <div class="md:col-span-2">
                        <dt class="text-sm text-gray-500 dark:text-gray-400">Dirección</dt>
                        <dd class="text-sm font-medium text-gray-900 dark:text-white">{{ $student->direccion }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm text-gray-500 dark:text-gray-400">Teléfono</dt>
                        <dd class="text-sm font-medium text-gray-900 dark:text-white">{{ $student->telefono }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm text-gray-500 dark:text-gray-400">Correo</dt>
                        <dd class="text-sm font-medium text-gray-900 dark:text-white">{{ $student->correo ?? '—' }}</dd>
                    </div>
                </dl>
            </div>

            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-6">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Tutor</h3>
                <dl class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="md:col-span-2">
                        <dt class="text-sm text-gray-500 dark:text-gray-400">Nombre del tutor</dt>
                        <dd class="text-sm font-medium text-gray-900 dark:text-white">{{ $student->nombre_tutor }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm text-gray-500 dark:text-gray-400">Teléfono del tutor</dt>
                        <dd class="text-sm font-medium text-gray-900 dark:text-white">{{ $student->telefono_tutor }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm text-gray-500 dark:text-gray-400">Correo del tutor</dt>
                        <dd class="text-sm font-medium text-gray-900 dark:text-white">{{ $student->correo_tutor ?? '—' }}</dd>
                    </div>
                </dl>
            </div>

            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-6">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Información Escolar</h3>
                <dl class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <dt class="text-sm text-gray-500 dark:text-gray-400">Grado</dt>
                        <dd class="text-sm font-medium text-gray-900 dark:text-white">{{ $student->grade->name }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm text-gray-500 dark:text-gray-400">Grupo</dt>
                        <dd class="text-sm font-medium text-gray-900 dark:text-white">{{ $student->grupo }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm text-gray-500 dark:text-gray-400">Fecha de ingreso</dt>
                        <dd class="text-sm font-medium text-gray-900 dark:text-white">{{ $student->fecha_ingreso->format('d/m/Y') }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm text-gray-500 dark:text-gray-400">Estado</dt>
                        <dd class="text-sm font-medium text-gray-900 dark:text-white">{{ $student->estado }}</dd>
                    </div>
                </dl>
            </div>
        </div>
    </div>
@endsection
