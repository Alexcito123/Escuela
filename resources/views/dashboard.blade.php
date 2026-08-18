@extends('layouts.app')

@section('title', 'Dashboard')

@section('page-title', 'Dashboard')

@section('content')

    {{-- Stats Cards --}}
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 sm:gap-6 mb-8">

        <div class="card relative overflow-hidden group">
            <div class="absolute top-0 right-0 w-32 h-32 bg-educlub/5 rounded-full -translate-y-1/2 translate-x-1/2 group-hover:scale-150 transition-transform duration-500"></div>
            <div class="relative">
                <div class="w-12 h-12 bg-educlub/10 rounded-2xl flex items-center justify-center mb-4">
                    <svg class="w-6 h-6 text-educlub" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                </div>
                <p class="text-3xl font-bold text-gray-800">{{ $totalGrados }}</p>
                <p class="text-sm text-gray-500 mt-1">Grados</p>
            </div>
        </div>

        <div class="card relative overflow-hidden group">
            <div class="absolute top-0 right-0 w-32 h-32 bg-orange-pastel/10 rounded-full -translate-y-1/2 translate-x-1/2 group-hover:scale-150 transition-transform duration-500"></div>
            <div class="relative">
                <div class="w-12 h-12 bg-orange-pastel/10 rounded-2xl flex items-center justify-center mb-4">
                    <svg class="w-6 h-6 text-orange-pastel" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"/></svg>
                </div>
                <p class="text-3xl font-bold text-gray-800">{{ $totalCarpetas }}</p>
                <p class="text-sm text-gray-500 mt-1">Carpetas</p>
            </div>
        </div>

        <div class="card relative overflow-hidden group">
            <div class="absolute top-0 right-0 w-32 h-32 bg-green-pastel/10 rounded-full -translate-y-1/2 translate-x-1/2 group-hover:scale-150 transition-transform duration-500"></div>
            <div class="relative">
                <div class="w-12 h-12 bg-green-pastel/10 rounded-2xl flex items-center justify-center mb-4">
                    <svg class="w-6 h-6 text-green-pastel" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                </div>
                <p class="text-3xl font-bold text-gray-800">{{ $totalArchivos }}</p>
                <p class="text-sm text-gray-500 mt-1">Archivos</p>
            </div>
        </div>

    </div>

    {{-- Quick Access --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 sm:gap-6">
        <a href="{{ route('archivero.index') }}" class="card flex items-center gap-4 group hover:border-educlub/30 border border-transparent">
            <div class="w-14 h-14 bg-educlub/10 rounded-2xl flex items-center justify-center group-hover:scale-110 transition-transform">
                <svg class="w-7 h-7 text-educlub" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"/></svg>
            </div>
            <div>
                <p class="font-semibold text-gray-800">Archivero</p>
                <p class="text-xs text-gray-400 mt-0.5">Gestionar carpetas y archivos escolares</p>
            </div>
        </a>
        <a href="{{ route('imagenes.index') }}" class="card flex items-center gap-4 group hover:border-green-pastel/30 border border-transparent">
            <div class="w-14 h-14 bg-green-pastel/10 rounded-2xl flex items-center justify-center group-hover:scale-110 transition-transform">
                <svg class="w-7 h-7 text-green-pastel" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
            </div>
            <div>
                <p class="font-semibold text-gray-800">Formato de Imágenes</p>
                <p class="text-xs text-gray-400 mt-0.5">Convertir imágenes a PDF tamaño carta</p>
            </div>
        </a>
    </div>

@endsection