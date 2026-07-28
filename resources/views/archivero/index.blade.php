@extends('layouts.archivero')

@section('title', 'Archivero')

@section('content')
    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 mb-8">
        <div>
            <h1 class="text-2xl sm:text-3xl font-extrabold text-gray-800">Grados Escolares</h1>
            <p class="text-sm text-gray-400 mt-1">{{ $grades->count() }} grados disponibles</p>
        </div>
        <div class="flex items-center gap-2 bg-white rounded-2xl px-4 py-2 shadow-sm border border-gray-100">
            <svg class="w-5 h-5 text-educlub" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"/></svg>
            <span class="text-sm font-medium text-gray-600">{{ $grades->count() }} grados</span>
        </div>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
        @foreach ($grades as $grade)
            <a href="{{ route('archivero.grade', $grade) }}"
               class="group relative bg-white rounded-2xl shadow-sm hover:shadow-lg border border-gray-100 p-6 transition-all duration-300 hover:-translate-y-1 hover:border-educlub/20 overflow-hidden">
                <div class="absolute top-0 right-0 w-24 h-24 bg-educlub/5 rounded-full -translate-y-1/2 translate-x-1/2 group-hover:scale-150 transition-transform duration-500"></div>
                <div class="relative flex items-start gap-4">
                    <div class="shrink-0 w-14 h-14 bg-gradient-to-br from-educlub to-educlub-light rounded-2xl flex items-center justify-center shadow-sm">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"/>
                        </svg>
                    </div>
                    <div class="flex-1 min-w-0">
                        <h3 class="text-lg font-bold text-gray-800 truncate group-hover:text-educlub transition-colors">{{ $grade->name }}</h3>
                        <p class="text-xs text-gray-400 mt-1.5">
                            <span class="inline-flex items-center gap-1 px-2.5 py-1 bg-gray-100 text-gray-600 text-xs font-medium rounded-lg">{{ $grade->level }}</span>
                        </p>
                        <p class="text-sm text-gray-400 mt-3 flex items-center gap-1.5">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"/></svg>
                            {{ $grade->folders_count ?? $grade->folders()->count() }} carpetas
                        </p>
                    </div>
                    <svg class="w-5 h-5 text-gray-300 group-hover:text-educlub transition-all group-hover:translate-x-1 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </div>
            </a>
        @endforeach
    </div>
@endsection
