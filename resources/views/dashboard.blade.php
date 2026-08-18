@extends('layouts.app')

@section('title', 'Dashboard')

@section('page-title', 'Dashboard')

@section('content')

    {{-- Stats Cards --}}
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6 mb-8">

        <div class="card relative overflow-hidden group">
            <div class="absolute top-0 right-0 w-32 h-32 bg-educlub/5 rounded-full -translate-y-1/2 translate-x-1/2 group-hover:scale-150 transition-transform duration-500"></div>
            <div class="relative">
                <div class="w-12 h-12 bg-educlub/10 rounded-2xl flex items-center justify-center mb-4">
                    <svg class="w-6 h-6 text-educlub" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z"/>
                    </svg>
                </div>
                <p class="text-3xl font-bold text-gray-800">{{ $totalAlumnos }}</p>
                <p class="text-sm text-gray-500 mt-1">Alumnos</p>
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
                <p class="text-3xl font-bold text-gray-800">{{ $totalDocentes }}</p>
                <p class="text-sm text-gray-500 mt-1">Docentes</p>
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
                <p class="text-3xl font-bold text-gray-800">{{ $totalCursos }}</p>
                <p class="text-sm text-gray-500 mt-1">Cursos</p>
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
                <p class="text-3xl font-bold text-gray-800">{{ $totalArchivos }}</p>
                <p class="text-sm text-gray-500 mt-1">Archivos</p>
            </div>
        </div>

    </div>

    {{-- Financial Cards --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6 mb-8">

        <div class="card">
            <p class="text-sm text-gray-500">Ingresos del Mes</p>
            <p class="text-2xl font-bold text-green-pastel mt-1">${{ number_format($pagosMes, 2) }}</p>
        </div>

        <div class="card">
            <p class="text-sm text-gray-500">Gastos del Mes</p>
            <p class="text-2xl font-bold text-red-500 mt-1">${{ number_format($gastosMes, 2) }}</p>
        </div>

        <div class="card">
            <p class="text-sm text-gray-500">Pagos del Día</p>
            <p class="text-2xl font-bold text-educlub mt-1">${{ number_format($pagosDia, 2) }}</p>
        </div>

        <div class="card">
            <p class="text-sm text-gray-500">Balance General</p>
            <p class="text-2xl font-bold {{ $balance >= 0 ? 'text-green-pastel' : 'text-red-500' }} mt-1">${{ number_format($balance, 2) }}</p>
        </div>

    </div>

    {{-- Charts & Activity --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">

        {{-- Monthly Chart --}}
        <div class="card lg:col-span-2">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-lg font-bold text-gray-800">Ingresos vs Gastos {{ now()->year }}</h3>
                <div class="flex items-center gap-2">
                    <span class="flex items-center gap-1 text-xs text-gray-500">
                        <span class="w-2.5 h-2.5 rounded-full bg-educlub"></span>
                        Ingresos
                    </span>
                    <span class="flex items-center gap-1 text-xs text-gray-500">
                        <span class="w-2.5 h-2.5 rounded-full bg-orange-pastel"></span>
                        Gastos
                    </span>
                </div>
            </div>
            @php
                $maxVal = max(max($chartIngresos), max($chartGastos), 1);
            @endphp
            <div class="h-48 flex items-end justify-between gap-2">
                @foreach ($meses as $i => $mes)
                    @php
                        $ingAlt = ($chartIngresos[$i] / $maxVal) * 100;
                        $gasAlt = ($chartGastos[$i] / $maxVal) * 100;
                    @endphp
                    <div class="flex-1 flex flex-col items-center gap-1">
                        <div class="w-full relative" style="height: 100px;">
                            <div class="absolute bottom-0 left-0 right-0 bg-educlub rounded-lg transition-all duration-500" style="height: {{ $ingAlt }}%;"></div>
                            <div class="absolute bottom-0 left-0 right-0 bg-orange-pastel rounded-lg transition-all duration-500" style="height: {{ $gasAlt }}%; opacity: 0.7;"></div>
                        </div>
                        <span class="text-xs text-gray-400">{{ $mes }}</span>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- Recent Activity --}}
        <div class="card">
            <h3 class="text-lg font-bold text-gray-800 mb-4">Últimos Movimientos</h3>
            <div class="space-y-4">
@forelse ($ultimosPagos as $pago)
                    <div class="flex items-start gap-3">
                        <div class="w-8 h-8 rounded-xl bg-green-pastel/10 flex items-center justify-center shrink-0 mt-0.5">
                            <svg class="w-4 h-4 text-green-pastel" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v12m-3-2.818l.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </div>
                        <div class="min-w-0">
                            <p class="text-sm font-medium text-gray-800">Pago: ${{ number_format($pago->monto, 2) }}</p>
                            <p class="text-xs text-gray-400 mt-0.5">{{ $pago->student->nombre_completo ?? '' }} - {{ $pago->concepto }}</p>
                            <p class="text-xs text-gray-300 mt-0.5">{{ $pago->fecha->format('d/m/Y') }}</p>
                        </div>
                    </div>
                @empty
                    <div class="text-sm text-gray-400">Sin pagos registrados</div>
                @endforelse
                @forelse ($ultimosGastos as $gasto)
                    <div class="flex items-start gap-3">
                        <div class="w-8 h-8 rounded-xl bg-red-100 flex items-center justify-center shrink-0 mt-0.5">
                            <svg class="w-4 h-4 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </div>
                        <div class="min-w-0">
                            <p class="text-sm font-medium text-gray-800">Gasto: ${{ number_format($gasto->monto, 2) }}</p>
                            <p class="text-xs text-gray-400 mt-0.5">{{ $gasto->concepto }} - {{ $gasto->categoria }}</p>
                            <p class="text-xs text-gray-300 mt-0.5">{{ $gasto->fecha->format('d/m/Y') }}</p>
                        </div>
                    </div>
                @empty
                    <div class="text-sm text-gray-400">Sin gastos registrados</div>
                @endforelse
            </div>
        </div>
    </div>

{{-- Students Table --}}
    <div class="card mb-8">
        <div class="flex items-center justify-between mb-6">
            <h3 class="text-lg font-bold text-gray-800">Últimos Alumnos Registrados</h3>
            <a href="{{ route('students.index') }}" class="btn-primary text-sm !py-2 !px-4">
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
                        <th class="text-left py-3.5 px-6 font-semibold">Alumno con adeudo</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse ($ultimosAlumnos as $student)
                        <tr class="bg-white hover:bg-educlub/5 transition-colors">
                            <td class="py-3.5 px-6 text-sm text-gray-700">{{ $student->nombre_completo }}</td>
                            <td class="py-3.5 px-6 text-sm text-gray-700">{{ $student->grade->name ?? '—' }}</td>
                            <td class="py-3.5 px-6 text-sm text-gray-700">{{ $student->nombre_tutor ?? '—' }}</td>
                            <td class="py-3.5 px-6">
                                <span class="inline-flex items-center gap-1 px-2.5 py-1 {{ $student->estado === 'Activo' ? 'bg-green-pastel/10 text-green-pastel' : 'bg-red-100 text-red-500' }} text-xs font-medium rounded-lg">
                                    <span class="w-1.5 h-1.5 rounded-full {{ $student->estado === 'Activo' ? 'bg-green-pastel' : 'bg-red-500' }}"></span>
                                    {{ $student->estado }}
                                </span>
                            </td>
                            <td class="py-3.5 px-6">
                                @php
                                    $adeudo = $student->payments()->where('estado', 'Pendiente')->exists();
                                @endphp
                                @if ($adeudo)
                                    <span class="inline-flex items-center gap-1 px-2.5 py-1 bg-yellow-soft/20 text-yellow-700 text-xs font-medium rounded-lg">
                                        <span class="w-1.5 h-1.5 rounded-full bg-yellow-soft"></span>
                                        Con adeudo
                                    </span>
                                @else
                                    <span class="text-xs text-gray-400">—</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="py-8 text-center text-sm text-gray-400">No hay alumnos registrados</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Quick Access --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6">
        <a href="{{ route('students.create') }}" class="card flex items-center gap-4 group hover:border-educlub/30 border border-transparent">
            <div class="w-14 h-14 bg-educlub/10 rounded-2xl flex items-center justify-center group-hover:scale-110 transition-transform">
                <svg class="w-7 h-7 text-educlub" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/></svg>
            </div>
            <div>
                <p class="font-semibold text-gray-800">Registrar Alumno</p>
                <p class="text-xs text-gray-400 mt-0.5">Agregar un nuevo estudiante</p>
            </div>
        </a>
        <a href="{{ route('payments.create') }}" class="card flex items-center gap-4 group hover:border-green-pastel/30 border border-transparent">
            <div class="w-14 h-14 bg-green-pastel/10 rounded-2xl flex items-center justify-center group-hover:scale-110 transition-transform">
                <svg class="w-7 h-7 text-green-pastel" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v12m-3-2.818l.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
            <div>
                <p class="font-semibold text-gray-800">Registrar Pago</p>
                <p class="text-xs text-gray-400 mt-0.5">Registrar un pago de alumno</p>
            </div>
        </a>
        <a href="{{ route('expenses.create') }}" class="card flex items-center gap-4 group hover:border-orange-pastel/30 border border-transparent">
            <div class="w-14 h-14 bg-orange-pastel/10 rounded-2xl flex items-center justify-center group-hover:scale-110 transition-transform">
                <svg class="w-7 h-7 text-orange-pastel" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
            <div>
                <p class="font-semibold text-gray-800">Registrar Gasto</p>
                <p class="text-xs text-gray-400 mt-0.5">Controlar egresos escolares</p>
            </div>
        </a>
        <a href="{{ route('archivero.index') }}" class="card flex items-center gap-4 group hover:border-pink-pastel/30 border border-transparent">
            <div class="w-14 h-14 bg-pink-pastel/10 rounded-2xl flex items-center justify-center group-hover:scale-110 transition-transform">
                <svg class="w-7 h-7 text-pink-pastel" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"/></svg>
            </div>
            <div>
                <p class="font-semibold text-gray-800">Subir Archivo</p>
                <p class="text-xs text-gray-400 mt-0.5">Compartir material educativo</p>
            </div>
        </a>
    </div>

@endsection
