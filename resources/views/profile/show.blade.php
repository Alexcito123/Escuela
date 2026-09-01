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

        {{-- Datos del perfil --}}
        <div class="p-6 sm:p-8">
            <div class="space-y-5">
                <div>
                    <label class="block text-xs font-semibold text-gray-400 uppercase tracking-wide mb-1">Nombre</label>
                    <p class="text-base font-medium text-gray-800">{{ auth()->user()->name }}</p>
                </div>

                <div>
                    <label class="block text-xs font-semibold text-gray-400 uppercase tracking-wide mb-1">Correo Electrónico</label>
                    <p class="text-base font-medium text-gray-800">{{ auth()->user()->email }}</p>
                </div>

                <div>
                    <label class="block text-xs font-semibold text-gray-400 uppercase tracking-wide mb-1">Miembro desde</label>
                    <p class="text-base font-medium text-gray-800">{{ auth()->user()->created_at->format('d/m/Y') }}</p>
                </div>
            </div>

            <div class="mt-8 flex items-center justify-end gap-3">
                <a href="{{ route('dashboard') }}" class="btn-secondary">
                    Volver
                </a>
                <a href="{{ route('perfil.edit') }}" class="btn-primary">
                    Editar Perfil
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
