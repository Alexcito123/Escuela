@extends('layouts.app')

@section('title', 'Mi Perfil')
@section('page-title', 'Mi Perfil')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="bg-white rounded-3xl shadow-xl shadow-gray-200/50 border border-gray-100 overflow-hidden">

        {{-- Header de perfil --}}
        <div class="bg-educlub p-6 relative" style="background-image: linear-gradient(to right, #4FC3E8, #2FA5CE, #7ED3A0);">
            <div class="flex items-center gap-4">
                <div class="w-16 h-16 rounded-full bg-white/20 flex items-center justify-center overflow-hidden">
                    @if (auth()->user()->avatar_url)
                        <img src="{{ auth()->user()->avatar_url }}" alt="Foto de perfil" class="w-full h-full object-cover">
                    @else
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                    @endif
                </div>
                <div>
                    <h2 class="text-xl font-bold text-white">{{ auth()->user()->name }}</h2>
                    <p class="text-sm text-white/80">{{ auth()->user()->email }}</p>
                </div>
            </div>
        </div>

        {{-- Formulario de edición --}}
        <form method="POST" action="{{ route('perfil.update') }}" enctype="multipart/form-data" class="p-6 sm:p-8">
            @csrf
            @method('PUT')

            <div class="space-y-5">
                {{-- Foto de perfil --}}
                <div class="flex items-center gap-4">
                    <div class="w-20 h-20 rounded-full bg-educlub/10 flex items-center justify-center overflow-hidden shrink-0">
                        @if (auth()->user()->avatar_url)
                            <img src="{{ auth()->user()->avatar_url }}" alt="Foto de perfil" class="w-full h-full object-cover">
                        @else
                            <svg class="w-9 h-9 text-educlub" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                        @endif
                    </div>
                    <div class="flex-1">
                        <label for="avatar" class="block text-sm font-semibold text-gray-700 mb-1.5">Foto de Perfil</label>
                        <input type="file" name="avatar" id="avatar" accept="image/*"
                            class="block w-full text-sm text-gray-500 file:mr-3 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-semibold file:bg-educlub file:text-white hover:file:bg-educlub-dark">
                        <p class="mt-1.5 text-xs text-gray-400">JPG, PNG, GIF o WEBP. Máximo 2MB.</p>
                        @error('avatar')
                            <p class="mt-1.5 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

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

        @if (auth()->user()->avatar_url)
            <div class="flex items-center justify-between bg-red-50 border-t border-red-100 px-4 py-3">
                <span class="text-sm text-gray-600">¿Eliminar tu foto de perfil actual?</span>
                <form method="POST" action="{{ route('perfil.destroyAvatar') }}"
                      onsubmit="return confirm('¿Eliminar tu foto de perfil?')" class="inline">
                    @csrf @method('DELETE')
                    <button type="submit" class="text-sm font-semibold text-red-500 hover:text-red-700">Eliminar foto</button>
                </form>
            </div>
        @endif
    </div>
</div>
@endsection
