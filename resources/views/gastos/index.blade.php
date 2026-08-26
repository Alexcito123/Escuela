@extends('layouts.archivero')

@section('title', 'Archivero de Gastos')

@section('content')
    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 mb-8">
        <div>
            <h1 class="text-2xl sm:text-3xl font-extrabold text-gray-800">Archivero de Gastos</h1>
            <p class="text-sm text-gray-400 mt-1">{{ $months->count() }} mes(es) registrado(s)</p>
        </div>
        <div class="flex items-center gap-2 bg-white rounded-2xl px-4 py-2 shadow-sm border border-gray-100">
            <svg class="w-5 h-5 text-orange-pastel" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
            <span class="text-sm font-medium text-gray-600">{{ $months->count() }} meses</span>
        </div>
    </div>

    @if ($months->count() > 0)
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @foreach ($months as $month)
                <a href="{{ route('gastos.month', $month) }}"
                   class="group relative bg-white rounded-2xl shadow-sm hover:shadow-lg border border-gray-100 p-6 transition-all duration-300 hover:-translate-y-1 hover:border-orange-pastel/20 overflow-hidden">
                    <div class="absolute top-0 right-0 w-24 h-24 bg-orange-pastel/5 rounded-full -translate-y-1/2 translate-x-1/2 group-hover:scale-150 transition-transform duration-500"></div>
                    <div class="relative flex items-start gap-4">
                        <div class="shrink-0 w-14 h-14 bg-gradient-to-br from-orange-pastel to-orange-pastel-dark rounded-2xl flex items-center justify-center shadow-sm">
                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <div class="flex-1 min-w-0">
                            <h3 class="text-lg font-bold text-gray-800 truncate group-hover:text-orange-pastel transition-colors">{{ $month->name }}</h3>
                            <p class="text-xs text-gray-400 mt-1.5">
                                <span class="inline-flex items-center gap-1 px-2.5 py-1 bg-gray-100 text-gray-600 text-xs font-medium rounded-lg">{{ $month->year }}</span>
                            </p>
                            <p class="text-sm text-gray-400 mt-3 flex items-center gap-1.5">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"/></svg>
                                {{ $month->weeks_count ?? $month->weeks()->count() }} semanas
                            </p>
                        </div>
                        <svg class="w-5 h-5 text-gray-300 group-hover:text-orange-pastel transition-all group-hover:translate-x-1 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </div>
                </a>
            @endforeach
        </div>
    @else
        <div class="text-center py-20">
            <div class="w-24 h-24 bg-orange-50 rounded-3xl flex items-center justify-center mx-auto mb-5">
                <svg class="w-12 h-12 text-orange-pastel" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
            </div>
            <h3 class="text-xl font-bold text-gray-700 mb-2">Sin meses registrados</h3>
            <p class="text-gray-400 mb-8">Crea tu primer mes para comenzar a registrar gastos.</p>
            <button onclick="document.getElementById('modalNuevo').classList.remove('hidden')"
                    class="btn-warning !py-3 !px-8">
                <span class="flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    Nuevo Mes
                </span>
            </button>
        </div>
    @endif

    <div id="modalNuevo" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black/40">
        <div class="bg-white rounded-2xl shadow-xl w-full max-w-md mx-4 p-6">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-xl font-bold text-gray-800">Nuevo Mes</h2>
                <button onclick="document.getElementById('modalNuevo').classList.add('hidden')" class="text-gray-400 hover:text-gray-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>
            <form method="POST" action="{{ route('gastos.storeMonth') }}">
                @csrf
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nombre</label>
                        <input type="text" name="name" required
                               placeholder="Ej: Agosto 2026"
                               class="input-field"
                               value="{{ old('name') }}">
                        @error('name') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Mes</label>
                            <select name="month_number" required class="input-field">
                                <option value="">Seleccionar</option>
                                @php $meses = ['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre']; @endphp
                                @foreach ($meses as $i => $m)
                                    <option value="{{ $i + 1 }}" {{ old('month_number') == $i + 1 ? 'selected' : '' }}>{{ $m }}</option>
                                @endforeach
                            </select>
                            @error('month_number') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Año</label>
                            <input type="number" name="year" required min="2020" max="2100"
                                   class="input-field"
                                   value="{{ old('year', date('Y')) }}">
                            @error('year') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                        </div>
                    </div>
                </div>
                <div class="flex justify-end gap-3 mt-6">
                    <button type="button" onclick="document.getElementById('modalNuevo').classList.add('hidden')"
                            class="px-5 py-2.5 text-sm font-medium text-gray-600 hover:text-gray-800 bg-gray-100 hover:bg-gray-200 rounded-xl transition-all">
                        Cancelar
                    </button>
                    <button type="submit" class="btn-warning !py-2.5 !px-5 text-sm">
                        Crear Mes
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
