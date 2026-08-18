@extends('layouts.app')

@section('title', 'Dashboard')

@section('page-title', 'Dashboard')

@section('content')

    {{-- Stats Cards --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6 mb-8">

        <div class="card relative overflow-hidden group">
            <div class="absolute top-0 right-0 w-32 h-32 bg-orange-pastel/10 rounded-full -translate-y-1/2 translate-x-1/2 group-hover:scale-150 transition-transform duration-500"></div>
            <div class="relative">
                <div class="w-12 h-12 bg-orange-pastel/10 rounded-2xl flex items-center justify-center mb-4">
                    <svg class="w-6 h-6 text-orange-pastel" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                    </svg>
                </div>
                <p class="text-3xl font-bold text-gray-800">12</p>
                <p class="text-sm text-gray-500 mt-1">Materias</p>
                <div class="mt-3 flex items-center gap-1 text-xs text-orange-pastel font-medium">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/></svg>
                    +1 este mes
                </div>
            </div>
        </div>

        <div class="card relative overflow-hidden group">
            <div class="absolute top-0 right-0 w-32 h-32 bg-pink-pastel/10 rounded-full -translate-y-1/2 translate-x-1/2 group-hover:scale-150 transition-transform duration-500"></div>
            <div class="relative">
                <div class="w-12 h-12 bg-pink-pastel/10 rounded-2xl flex items-center justify-center mb-4">
                    <svg class="w-6 h-6 text-pink-pastel" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"/>
                    </svg>
                </div>
                <p class="text-3xl font-bold text-gray-800">1,284</p>
                <p class="text-sm text-gray-500 mt-1">Archivos</p>
                <div class="mt-3 flex items-center gap-1 text-xs text-pink-pastel font-medium">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/></svg>
                    +23 este mes
                </div>
            </div>
        </div>

    </div>

    {{-- Charts & Recent Activity --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">

        {{-- Chart Card --}}
        <div class="card lg:col-span-2">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-lg font-bold text-gray-800">Estadísticas Semanales</h3>
                <div class="flex items-center gap-2">
                    <span class="flex items-center gap-1 text-xs text-gray-500">
                        <span class="w-2.5 h-2.5 rounded-full bg-educlub"></span>
                        Visitas
                    </span>
                    <span class="flex items-center gap-1 text-xs text-gray-500">
                        <span class="w-2.5 h-2.5 rounded-full bg-orange-pastel"></span>
                        Actividad
                    </span>
                </div>
            </div>
            <div class="h-48 flex items-end justify-between gap-2">
                <div class="flex-1 flex flex-col items-center gap-1">
                    <div class="w-full bg-educlub/10 rounded-lg relative" style="height: 100px;">
                        <div class="absolute bottom-0 left-0 right-0 bg-educlub rounded-lg transition-all duration-500" style="height: 65%;"></div>
                    </div>
                    <span class="text-xs text-gray-400">Lun</span>
                </div>
                <div class="flex-1 flex flex-col items-center gap-1">
                    <div class="w-full bg-orange-pastel/10 rounded-lg relative" style="height: 100px;">
                        <div class="absolute bottom-0 left-0 right-0 bg-orange-pastel rounded-lg transition-all duration-500" style="height: 45%;"></div>
                    </div>
                    <span class="text-xs text-gray-400">Mar</span>
                </div>
                <div class="flex-1 flex flex-col items-center gap-1">
                    <div class="w-full bg-educlub/10 rounded-lg relative" style="height: 100px;">
                        <div class="absolute bottom-0 left-0 right-0 bg-educlub rounded-lg transition-all duration-500" style="height: 80%;"></div>
                    </div>
                    <span class="text-xs text-gray-400">Mié</span>
                </div>
                <div class="flex-1 flex flex-col items-center gap-1">
                    <div class="w-full bg-orange-pastel/10 rounded-lg relative" style="height: 100px;">
                        <div class="absolute bottom-0 left-0 right-0 bg-orange-pastel rounded-lg transition-all duration-500" style="height: 55%;"></div>
                    </div>
                    <span class="text-xs text-gray-400">Jue</span>
                </div>
                <div class="flex-1 flex flex-col items-center gap-1">
                    <div class="w-full bg-educlub/10 rounded-lg relative" style="height: 100px;">
                        <div class="absolute bottom-0 left-0 right-0 bg-educlub rounded-lg transition-all duration-500" style="height: 90%;"></div>
                    </div>
                    <span class="text-xs text-gray-400">Vie</span>
                </div>
                <div class="flex-1 flex flex-col items-center gap-1">
                    <div class="w-full bg-orange-pastel/10 rounded-lg relative" style="height: 100px;">
                        <div class="absolute bottom-0 left-0 right-0 bg-orange-pastel rounded-lg transition-all duration-500" style="height: 30%;"></div>
                    </div>
                    <span class="text-xs text-gray-400">Sáb</span>
                </div>
                <div class="flex-1 flex flex-col items-center gap-1">
                    <div class="w-full bg-educlub/10 rounded-lg relative" style="height: 100px;">
                        <div class="absolute bottom-0 left-0 right-0 bg-educlub rounded-lg transition-all duration-500" style="height: 20%;"></div>
                    </div>
                    <span class="text-xs text-gray-400">Dom</span>
                </div>
            </div>
        </div>

        {{-- Recent Activity --}}
        <div class="card">
            <h3 class="text-lg font-bold text-gray-800 mb-4">Actividad Reciente</h3>
            <div class="space-y-4">
                <div class="flex items-start gap-3">
                    <div class="w-8 h-8 rounded-xl bg-green-pastel/10 flex items-center justify-center shrink-0 mt-0.5">
                        <svg class="w-4 h-4 text-green-pastel" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <div class="min-w-0">
                        <p class="text-sm font-medium text-gray-800">Archivo subido</p>
                        <p class="text-xs text-gray-400 mt-0.5">Planificación Semanal - 2° Grado</p>
                        <p class="text-xs text-gray-300 mt-0.5">Hace 1 hora</p>
                    </div>
                </div>
                <div class="flex items-start gap-3">
                    <div class="w-8 h-8 rounded-xl bg-pink-pastel/10 flex items-center justify-center shrink-0 mt-0.5">
                        <svg class="w-4 h-4 text-pink-pastel" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    </div>
                    <div class="min-w-0">
                        <p class="text-sm font-medium text-gray-800">Evento creado</p>
                        <p class="text-xs text-gray-400 mt-0.5">Junta de Padres - Viernes 4PM</p>
                        <p class="text-xs text-gray-300 mt-0.5">Hace 1 día</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Quick Access --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6">
        <a href="{{ route('archivero.index') }}" class="card flex items-center gap-4 group hover:border-green-pastel/30 border border-transparent">
            <div class="w-14 h-14 bg-green-pastel/10 rounded-2xl flex items-center justify-center group-hover:scale-110 transition-transform">
                <svg class="w-7 h-7 text-green-pastel" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"/></svg>
            </div>
            <div>
                <p class="font-semibold text-gray-800">Subir Archivo</p>
                <p class="text-xs text-gray-400 mt-0.5">Compartir material educativo</p>
            </div>
        </a>
    </div>

@endsection
