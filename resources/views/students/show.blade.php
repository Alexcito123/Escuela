@extends('layouts.archivero')

@section('title', $student->nombre_completo)

@section('content')
    <div class="flex items-center mb-6">
        <a href="{{ route('students.index') }}" class="text-gray-400 hover:text-gray-600 mr-4">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
        </a>
        <h1 class="text-2xl font-bold text-gray-900">{{ $student->nombre_completo }}</h1>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="lg:col-span-1">
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 text-center">
                <div class="w-32 h-32 rounded-full bg-gray-100 mx-auto mb-4 flex items-center justify-center overflow-hidden">
                    @if ($student->fotografia)
                        <img src="{{ asset('storage/' . $student->fotografia) }}" alt="" class="w-full h-full object-cover">
                    @else
                        <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                    @endif
                </div>
                <h2 class="text-xl font-bold text-gray-900">{{ $student->nombre_completo }}</h2>
                <p class="text-sm text-gray-500 mt-1">{{ $student->grade->name }} · Grupo {{ $student->grupo }}</p>
                <div class="mt-4">
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium {{ $student->estado === 'Activo' ? 'bg-green-pastel/10 text-green-pastel' : 'bg-red-100 text-red-800' }}">
                        {{ $student->estado }}
                    </span>
                </div>
                <div class="mt-6 flex justify-center gap-3">
                    <a href="{{ route('students.edit', $student) }}" class="bg-educlub hover:bg-educlub text-white px-4 py-2 rounded-xl text-sm font-medium transition">
                        Editar
                    </a>
                    <form method="POST" action="{{ route('students.destroy', $student) }}" onsubmit="return confirm('¿Eliminar este alumno?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="bg-pink-pastel hover:bg-pink-pastel text-white px-4 py-2 rounded-xl text-sm font-medium transition">
                            Eliminar
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <div class="lg:col-span-2 space-y-6">
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Información Personal</h3>
                <dl class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <dt class="text-sm text-gray-500">Nombre</dt>
                        <dd class="text-sm font-medium text-gray-900">{{ $student->nombre }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm text-gray-500">Apellido paterno</dt>
                        <dd class="text-sm font-medium text-gray-900">{{ $student->apellido_paterno }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm text-gray-500">Apellido materno</dt>
                        <dd class="text-sm font-medium text-gray-900">{{ $student->apellido_materno }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm text-gray-500">Fecha de nacimiento</dt>
                        <dd class="text-sm font-medium text-gray-900">{{ $student->fecha_nacimiento->format('d/m/Y') }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm text-gray-500">CURP</dt>
                        <dd class="text-sm font-medium text-gray-900">{{ $student->curp ?? '—' }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm text-gray-500">Sexo</dt>
                        <dd class="text-sm font-medium text-gray-900">{{ $student->sexo }}</dd>
                    </div>
                    <div class="md:col-span-2">
                        <dt class="text-sm text-gray-500">Dirección</dt>
                        <dd class="text-sm font-medium text-gray-900">{{ $student->direccion }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm text-gray-500">Teléfono</dt>
                        <dd class="text-sm font-medium text-gray-900">{{ $student->telefono }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm text-gray-500">Correo</dt>
                        <dd class="text-sm font-medium text-gray-900">{{ $student->correo ?? '—' }}</dd>
                    </div>
                </dl>
            </div>

            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Tutor</h3>
                <dl class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="md:col-span-2">
                        <dt class="text-sm text-gray-500">Nombre del tutor</dt>
                        <dd class="text-sm font-medium text-gray-900">{{ $student->nombre_tutor }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm text-gray-500">Teléfono del tutor</dt>
                        <dd class="text-sm font-medium text-gray-900">{{ $student->telefono_tutor }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm text-gray-500">Correo del tutor</dt>
                        <dd class="text-sm font-medium text-gray-900">{{ $student->correo_tutor ?? '—' }}</dd>
                    </div>
                </dl>
            </div>

            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Información Escolar</h3>
                <dl class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <dt class="text-sm text-gray-500">Grado</dt>
                        <dd class="text-sm font-medium text-gray-900">{{ $student->grade->name }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm text-gray-500">Grupo</dt>
                        <dd class="text-sm font-medium text-gray-900">{{ $student->grupo }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm text-gray-500">Fecha de ingreso</dt>
                        <dd class="text-sm font-medium text-gray-900">{{ $student->fecha_ingreso->format('d/m/Y') }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm text-gray-500">Estado</dt>
                        <dd class="text-sm font-medium text-gray-900">{{ $student->estado }}</dd>
                    </div>
                </dl>
            </div>
        </div>
    </div>
@endsection
