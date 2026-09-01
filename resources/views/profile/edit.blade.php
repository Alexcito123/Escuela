@extends('layouts.app')

@section('title', 'Mi Perfil')
@section('page-title', 'Mi Perfil')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="bg-white rounded-3xl shadow-xl shadow-gray-200/50 border border-gray-100 overflow-hidden">

        {{-- Header de perfil --}}
        <div class="bg-educlub p-6 relative">
            <div class="flex items-center gap-4">
                <div class="w-16 h-16 rounded-full bg-white/20 flex items-center justify-center">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                </div>
                <div>
                    <h2 class="text-xl font-bold text-white">{{ auth()->user()->name }}</h2>
                    <p class="text-sm text-white/80">{{ auth()->user()->email }}</p>
                </div>
            </div>
        </div>

        {{-- Formulario de edición --}}
        <form method="POST" action="{{ route('perfil.update') }}" class="p-6 sm:p-8">
            @csrf
            @method('PUT')

            <div class="space-y-5">
                <div>
                    <label for="name" class="block text-sm font-semibold text-gray-700 mb-1.5">Nombre</label>
                    <input type="text" name="name" id="name" value="{{ old('name', auth()->user()->name) }}"
                        class="input-field @error('name') border-red-300 focus:ring-red-300 focus:border-red-300 @enderror"
                        required>
                    @error('name')
                        <p class="mt-1.5 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="email" class="block text-sm font-semibold text-gray-700 mb-1.5">Correo Electrónico</label>
                    <input type="email" name="email" id="email" value="{{ old('email', auth()->user()->email) }}"
                        class="input-field @error('email') border-red-300 focus:ring-red-300 focus:border-red-300 @enderror"
                        required>
                    @error('email')
                        <p class="mt-1.5 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div class="border-t border-gray-100 pt-5">
                    <p class="text-sm font-semibold text-gray-700 mb-1.5">Cambiar Contraseña</p>
                    <p class="text-xs text-gray-500 mb-4">Déjalo en blanco si no deseas cambiarla.</p>

                    <div class="space-y-4">
                        <div>
                            <label for="password" class="block text-sm font-semibold text-gray-700 mb-1.5">Nueva Contraseña</label>
                            <input type="password" name="password" id="password" autocomplete="new-password"
                                class="input-field @error('password') border-red-300 focus:ring-red-300 focus:border-red-300 @enderror">
                            @error('password')
                                <p class="mt-1.5 text-xs text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="password_confirmation" class="block text-sm font-semibold text-gray-700 mb-1.5">Confirmar Contraseña</label>
                            <input type="password" name="password_confirmation" id="password_confirmation" autocomplete="new-password"
                                class="input-field">
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-8 flex items-center justify-end gap-3">
                <a href="{{ route('dashboard') }}" class="btn-secondary">
                    Cancelar
                </a>
                <button type="submit" class="btn-primary">
                    Guardar Cambios
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
