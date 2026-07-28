@extends('layouts.app')

@section('title', 'Dashboard')

@section('page-title', 'Dashboard')

@section('content')

    {{-- Stats Cards --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4 sm:gap-6 mb-8">

        <div class="card relative overflow-hidden group">
            <div class="absolute top-0 right-0 w-32 h-32 bg-educlub/5 rounded-full -translate-y-1/2 translate-x-1/2 group-hover:scale-150 transition-transform duration-500"></div>
            <div class="relative">
                <div class="w-12 h-12 bg-educlub/10 rounded-2xl flex items-center justify-center mb-4">
                    <svg class="w-6 h-6 text-educlub" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z"/>
                    </svg>
                </div>
                <p class="text-3xl font-bold text-gray-800">156</p>
                <p class="text-sm text-gray-500 mt-1">Alumnos Registrados</p>
                <div class="mt-3 flex items-center gap-1 text-xs text-green-pastel font-medium">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"/></svg>
                    +12 esta semana
                </div>
            </div>
        </div>

        <div class="card relative overflow-hidden group">
            <div class="absolute top-0 right-0 w-32 h-32 bg-green-pastel/10 rounded-full -translate-y-1/2 translate-x-1/2 group-hover:scale-150 transition-transform duration-500"></div>
            <div class="relative">
                <div class="w-12 h-12 bg-green-pastel/10 rounded-2xl flex items-center justify-center mb-4">
                    <svg class="w-6 h-6 text-green-pastel" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                </div>
                <p class="text-3xl font-bold text-gray-800">24</p>
                <p class="text-sm text-gray-500 mt-1">Docentes</p>
                <div class="mt-3 flex items-center gap-1 text-xs text-green-pastel font-medium">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"/></svg>
                    +2 esta semana
                </div>
            </div>
        </div>

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
                    <div class="w-8 h-8 rounded-xl bg-educlub/10 flex items-center justify-center shrink-0 mt-0.5">
                        <svg class="w-4 h-4 text-educlub" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/></svg>
                    </div>
                    <div class="min-w-0">
                        <p class="text-sm font-medium text-gray-800">Nuevo alumno registrado</p>
                        <p class="text-xs text-gray-400 mt-0.5">María García - 1° Primaria</p>
                        <p class="text-xs text-gray-300 mt-0.5">Hace 5 minutos</p>
                    </div>
                </div>
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
                    <div class="w-8 h-8 rounded-xl bg-orange-pastel/10 flex items-center justify-center shrink-0 mt-0.5">
                        <svg class="w-4 h-4 text-orange-pastel" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    </div>
                    <div class="min-w-0">
                        <p class="text-sm font-medium text-gray-800">Reporte generado</p>
                        <p class="text-xs text-gray-400 mt-0.5">Reporte de Calificaciones - Junio</p>
                        <p class="text-xs text-gray-300 mt-0.5">Hace 3 horas</p>
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

    {{-- Tables --}}
    <div class="card mb-8">
        <div class="flex items-center justify-between mb-6">
            <h3 class="text-lg font-bold text-gray-800">Últimos Alumnos Registrados</h3>
            <a href="#" class="btn-primary text-sm !py-2 !px-4">
                Ver Todos
            </a>
        </div>
        <div class="overflow-x-auto -mx-6">
            <table class="w-full">
                <thead>
                    <tr class="bg-educlub text-white text-sm">
                        <th class="text-left py-3.5 px-6 font-semibold">Nombre</th>
                        <th class="text-left py-3.5 px-6 font-semibold">Grado</th>
                        <th class="text-left py-3.5 px-6 font-semibold">Tutor</th>
                        <th class="text-left py-3.5 px-6 font-semibold">Estado</th>
                        <th class="text-left py-3.5 px-6 font-semibold">Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    <tr class="bg-white hover:bg-educlub/5 transition-colors">
                        <td class="py-3.5 px-6 text-sm text-gray-700">Sofía Martínez</td>
                        <td class="py-3.5 px-6 text-sm text-gray-700">1° Primaria</td>
                        <td class="py-3.5 px-6 text-sm text-gray-700">Laura Martínez</td>
                        <td class="py-3.5 px-6">
                            <span class="inline-flex items-center gap-1 px-2.5 py-1 bg-green-pastel/10 text-green-pastel text-xs font-medium rounded-lg">
                                <span class="w-1.5 h-1.5 rounded-full bg-green-pastel"></span>
                                Activo
                            </span>
                        </td>
                        <td class="py-3.5 px-6">
                            <button class="text-educlub hover:text-educlub-dark transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            </button>
                        </td>
                    </tr>
                    <tr class="bg-gray-50/50 hover:bg-educlub/5 transition-colors">
                        <td class="py-3.5 px-6 text-sm text-gray-700">Mateo López</td>
                        <td class="py-3.5 px-6 text-sm text-gray-700">2° Primaria</td>
                        <td class="py-3.5 px-6 text-sm text-gray-700">Carlos López</td>
                        <td class="py-3.5 px-6">
                            <span class="inline-flex items-center gap-1 px-2.5 py-1 bg-green-pastel/10 text-green-pastel text-xs font-medium rounded-lg">
                                <span class="w-1.5 h-1.5 rounded-full bg-green-pastel"></span>
                                Activo
                            </span>
                        </td>
                        <td class="py-3.5 px-6">
                            <button class="text-educlub hover:text-educlub-dark transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            </button>
                        </td>
                    </tr>
                    <tr class="bg-white hover:bg-educlub/5 transition-colors">
                        <td class="py-3.5 px-6 text-sm text-gray-700">Valentina Cruz</td>
                        <td class="py-3.5 px-6 text-sm text-gray-700">Preescolar</td>
                        <td class="py-3.5 px-6 text-sm text-gray-700">Ana Cruz</td>
                        <td class="py-3.5 px-6">
                            <span class="inline-flex items-center gap-1 px-2.5 py-1 bg-yellow-soft/20 text-yellow-700 text-xs font-medium rounded-lg">
                                <span class="w-1.5 h-1.5 rounded-full bg-yellow-soft"></span>
                                Pendiente
                            </span>
                        </td>
                        <td class="py-3.5 px-6">
                            <button class="text-educlub hover:text-educlub-dark transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    {{-- Quick Access --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6">
        <a href="#" class="card flex items-center gap-4 group hover:border-educlub/30 border border-transparent">
            <div class="w-14 h-14 bg-educlub/10 rounded-2xl flex items-center justify-center group-hover:scale-110 transition-transform">
                <svg class="w-7 h-7 text-educlub" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/></svg>
            </div>
            <div>
                <p class="font-semibold text-gray-800">Registrar Alumno</p>
                <p class="text-xs text-gray-400 mt-0.5">Agregar un nuevo estudiante</p>
            </div>
        </a>
        <a href="{{ route('archivero.index') }}" class="card flex items-center gap-4 group hover:border-green-pastel/30 border border-transparent">
            <div class="w-14 h-14 bg-green-pastel/10 rounded-2xl flex items-center justify-center group-hover:scale-110 transition-transform">
                <svg class="w-7 h-7 text-green-pastel" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"/></svg>
            </div>
            <div>
                <p class="font-semibold text-gray-800">Subir Archivo</p>
                <p class="text-xs text-gray-400 mt-0.5">Compartir material educativo</p>
            </div>
        </a>
        <a href="#" class="card flex items-center gap-4 group hover:border-orange-pastel/30 border border-transparent">
            <div class="w-14 h-14 bg-orange-pastel/10 rounded-2xl flex items-center justify-center group-hover:scale-110 transition-transform">
                <svg class="w-7 h-7 text-orange-pastel" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
            </div>
            <div>
                <p class="font-semibold text-gray-800">Ver Reportes</p>
                <p class="text-xs text-gray-400 mt-0.5">Estadísticas y rendimiento</p>
            </div>
        </a>
    </div>

@endsection
