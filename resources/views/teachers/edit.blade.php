@extends('layouts.archivero')

@section('title', 'Editar Docente')

@section('content')
    <div class="max-w-3xl mx-auto">
        <div class="flex items-center mb-6">
            <a href="{{ route('teachers.index') }}" class="text-gray-400 hover:text-gray-600 mr-4">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
            </a>
            <h1 class="text-2xl font-bold text-gray-900">Editar Docente</h1>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8">
            <form method="POST" action="{{ route('teachers.update', $teacher) }}" enctype="multipart/form-data" class="space-y-6">
                @csrf @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nombre <span class="text-red-500">*</span></label>
                        <input type="text" name="nombre" value="{{ old('nombre', $teacher->nombre) }}" required
                               class="w-full rounded-xl border border-gray-200 px-4 py-2 text-sm focus:ring-2 focus:ring-educlub/30 focus:border-educlub">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Apellido paterno <span class="text-red-500">*</span></label>
                        <input type="text" name="apellido_paterno" value="{{ old('apellido_paterno', $teacher->apellido_paterno) }}" required
                               class="w-full rounded-xl border border-gray-200 px-4 py-2 text-sm focus:ring-2 focus:ring-educlub/30 focus:border-educlub">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Apellido materno <span class="text-red-500">*</span></label>
                        <input type="text" name="apellido_materno" value="{{ old('apellido_materno', $teacher->apellido_materno) }}" required
                               class="w-full rounded-xl border border-gray-200 px-4 py-2 text-sm focus:ring-2 focus:ring-educlub/30 focus:border-educlub">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Fecha de nacimiento <span class="text-red-500">*</span></label>
                        <input type="date" name="fecha_nacimiento" value="{{ old('fecha_nacimiento', $teacher->fecha_nacimiento->format('Y-m-d')) }}" required
                               class="w-full rounded-xl border border-gray-200 px-4 py-2 text-sm focus:ring-2 focus:ring-educlub/30 focus:border-educlub">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">CURP</label>
                        <input type="text" name="curp" value="{{ old('curp', $teacher->curp) }}" maxlength="18"
                               class="w-full rounded-xl border border-gray-200 px-4 py-2 text-sm focus:ring-2 focus:ring-educlub/30 focus:border-educlub uppercase">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Sexo <span class="text-red-500">*</span></label>
                        <select name="sexo" required
                                class="w-full rounded-xl border border-gray-200 px-4 py-2 text-sm focus:ring-2 focus:ring-educlub/30 focus:border-educlub">
                            <option value="Masculino" {{ old('sexo', $teacher->sexo) == 'Masculino' ? 'selected' : '' }}>Masculino</option>
                            <option value="Femenino" {{ old('sexo', $teacher->sexo) == 'Femenino' ? 'selected' : '' }}>Femenino</option>
                        </select>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Dirección <span class="text-red-500">*</span></label>
                    <textarea name="direccion" rows="2" required
                              class="w-full rounded-xl border border-gray-200 px-4 py-2 text-sm focus:ring-2 focus:ring-educlub/30 focus:border-educlub">{{ old('direccion', $teacher->direccion) }}</textarea>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Teléfono <span class="text-red-500">*</span></label>
                        <input type="text" name="telefono" value="{{ old('telefono', $teacher->telefono) }}" required maxlength="20"
                               class="w-full rounded-xl border border-gray-200 px-4 py-2 text-sm focus:ring-2 focus:ring-educlub/30 focus:border-educlub">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Correo electrónico</label>
                        <input type="email" name="correo" value="{{ old('correo', $teacher->correo) }}"
                               class="w-full rounded-xl border border-gray-200 px-4 py-2 text-sm focus:ring-2 focus:ring-educlub/30 focus:border-educlub">
                    </div>
                </div>

                <x-section-title color="orange">Información Profesional</x-section-title>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Especialidad <span class="text-red-500">*</span></label>
                        <input type="text" name="especialidad" value="{{ old('especialidad', $teacher->especialidad) }}" required
                               class="w-full rounded-xl border border-gray-200 px-4 py-2 text-sm focus:ring-2 focus:ring-educlub/30 focus:border-educlub">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Cédula profesional</label>
                        <input type="text" name="cedula_profesional" value="{{ old('cedula_profesional', $teacher->cedula_profesional) }}"
                               class="w-full rounded-xl border border-gray-200 px-4 py-2 text-sm focus:ring-2 focus:ring-educlub/30 focus:border-educlub">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Fecha de ingreso <span class="text-red-500">*</span></label>
                        <input type="date" name="fecha_ingreso" value="{{ old('fecha_ingreso', $teacher->fecha_ingreso->format('Y-m-d')) }}" required
                               class="w-full rounded-xl border border-gray-200 px-4 py-2 text-sm focus:ring-2 focus:ring-educlub/30 focus:border-educlub">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Estado <span class="text-red-500">*</span></label>
                        <select name="estado" required
                                class="w-full rounded-xl border border-gray-200 px-4 py-2 text-sm focus:ring-2 focus:ring-educlub/30 focus:border-educlub">
                            <option value="Activo" {{ old('estado', $teacher->estado) == 'Activo' ? 'selected' : '' }}>Activo</option>
                            <option value="Inactivo" {{ old('estado', $teacher->estado) == 'Inactivo' ? 'selected' : '' }}>Inactivo</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Fotografía</label>
                        @if ($teacher->fotografia)
                            <div class="mb-2">
                                <img src="{{ asset('storage/' . $teacher->fotografia) }}" class="w-16 h-16 rounded-full object-cover">
                            </div>
                        @endif
                        <input type="file" name="fotografia" accept="image/jpeg,image/png"
                               class="w-full text-sm text-gray-600 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-medium file:bg-educlub/10 file:text-educlub hover:file:bg-educlub/20">
                    </div>
                </div>

                <div class="flex items-center justify-between pt-4 border-t border-gray-200">
                    <a href="{{ route('teachers.index') }}" class="text-sm text-gray-600 hover:text-gray-900 transition">Cancelar</a>
                    <button type="submit" class="bg-educlub hover:bg-educlub text-white px-6 py-2 rounded-xl font-medium transition">Actualizar Docente</button>
                </div>
            </form>
        </div>
    </div>
@endsection
