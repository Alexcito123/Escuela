@extends('layouts.archivero')

@section('title', $teacher->nombre_completo)

@section('content')
    <div class="flex items-center mb-6">
        <a href="{{ route('teachers.index') }}" class="text-gray-400 hover:text-gray-600 mr-4">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
        </a>
        <h1 class="text-2xl font-bold text-gray-900">{{ $teacher->nombre_completo }}</h1>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="lg:col-span-1">
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 text-center">
                <div class="w-32 h-32 rounded-full bg-gray-100 mx-auto mb-4 flex items-center justify-center overflow-hidden">
                    @if ($teacher->fotografia)
                        <img src="{{ asset('storage/' . $teacher->fotografia) }}" alt="" class="w-full h-full object-cover">
                    @else
                        <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                    @endif
                </div>
                <h2 class="text-xl font-bold text-gray-900">{{ $teacher->nombre_completo }}</h2>
                <p class="text-sm text-gray-500 mt-1">{{ $teacher->especialidad }}</p>
                <div class="mt-4">
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium {{ $teacher->estado === 'Activo' ? 'bg-green-pastel/10 text-green-pastel' : 'bg-red-100 text-red-800' }}">
                        {{ $teacher->estado }}
                    </span>
                </div>
                <div class="mt-6 flex justify-center gap-3">
                    <a href="{{ route('teachers.edit', $teacher) }}" class="bg-educlub hover:bg-educlub text-white px-4 py-2 rounded-xl text-sm font-medium transition">Editar</a>
                    <form method="POST" action="{{ route('teachers.destroy', $teacher) }}" onsubmit="return confirm('¿Eliminar este docente?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="bg-pink-pastel hover:bg-pink-pastel text-white px-4 py-2 rounded-xl text-sm font-medium transition">Eliminar</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="lg:col-span-2 space-y-6">
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Información Personal</h3>
                <dl class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <dt class="text-sm text-gray-500">Nombre completo</dt>
                        <dd class="text-sm font-medium text-gray-900">{{ $teacher->nombre_completo }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm text-gray-500">Fecha de nacimiento</dt>
                        <dd class="text-sm font-medium text-gray-900">{{ $teacher->fecha_nacimiento->format('d/m/Y') }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm text-gray-500">CURP</dt>
                        <dd class="text-sm font-medium text-gray-900">{{ $teacher->curp ?? '—' }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm text-gray-500">Sexo</dt>
                        <dd class="text-sm font-medium text-gray-900">{{ $teacher->sexo }}</dd>
                    </div>
                    <div class="md:col-span-2">
                        <dt class="text-sm text-gray-500">Dirección</dt>
                        <dd class="text-sm font-medium text-gray-900">{{ $teacher->direccion }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm text-gray-500">Teléfono</dt>
                        <dd class="text-sm font-medium text-gray-900">{{ $teacher->telefono }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm text-gray-500">Correo</dt>
                        <dd class="text-sm font-medium text-gray-900">{{ $teacher->correo ?? '—' }}</dd>
                    </div>
                </dl>
            </div>

            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Información Profesional</h3>
                <dl class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <dt class="text-sm text-gray-500">Especialidad</dt>
                        <dd class="text-sm font-medium text-gray-900">{{ $teacher->especialidad }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm text-gray-500">Cédula profesional</dt>
                        <dd class="text-sm font-medium text-gray-900">{{ $teacher->cedula_profesional ?? '—' }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm text-gray-500">Fecha de ingreso</dt>
                        <dd class="text-sm font-medium text-gray-900">{{ $teacher->fecha_ingreso->format('d/m/Y') }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm text-gray-500">Estado</dt>
                        <dd class="text-sm font-medium text-gray-900">{{ $teacher->estado }}</dd>
                    </div>
                </dl>
            </div>
        </div>
    </div>
@endsection
