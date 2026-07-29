@extends('layouts.archivero')

@section('title', 'Nuevo Gasto')

@section('content')
    <div class="max-w-3xl mx-auto">
        <div class="flex items-center mb-6">
            <a href="{{ route('expenses.index') }}" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300 mr-4">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
            </a>
            <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Nuevo Gasto</h1>
        </div>

        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-8">
            <form method="POST" action="{{ route('expenses.store') }}" class="space-y-6">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Concepto <span class="text-red-500">*</span></label>
                        <input type="text" name="concepto" value="{{ old('concepto') }}" required maxlength="255"
                               class="w-full rounded-lg border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white px-4 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                               placeholder="Ej: Compra de material didáctico">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Categoría <span class="text-red-500">*</span></label>
                        <select name="categoria" required
                                class="w-full rounded-lg border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white px-4 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <option value="">Seleccionar</option>
                            @foreach ($categorias as $c)
                                <option value="{{ $c }}" {{ old('categoria') == $c ? 'selected' : '' }}>{{ $c }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Monto <span class="text-red-500">*</span></label>
                        <div class="relative">
                            <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-500 text-sm">$</span>
                            <input type="number" step="0.01" min="0.01" name="monto" value="{{ old('monto') }}" required
                                   class="w-full rounded-lg border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white pl-8 pr-4 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Fecha <span class="text-red-500">*</span></label>
                        <input type="date" name="fecha" value="{{ old('fecha', date('Y-m-d')) }}" required
                               class="w-full rounded-lg border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white px-4 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Método de pago <span class="text-red-500">*</span></label>
                        <select name="metodo_pago" required
                                class="w-full rounded-lg border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white px-4 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            @foreach ($metodos as $m)
                                <option value="{{ $m }}" {{ old('metodo_pago') == $m ? 'selected' : '' }}>{{ $m }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Proveedor</label>
                    <input type="text" name="proveedor" value="{{ old('proveedor') }}" maxlength="255"
                           class="w-full rounded-lg border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white px-4 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                           placeholder="Nombre del proveedor">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Observaciones</label>
                    <textarea name="observaciones" rows="3"
                              class="w-full rounded-lg border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white px-4 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500">{{ old('observaciones') }}</textarea>
                </div>

                <div class="flex items-center justify-between pt-4 border-t border-gray-200 dark:border-gray-700">
                    <a href="{{ route('expenses.index') }}" class="text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white transition">Cancelar</a>
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg font-medium transition">Guardar Gasto</button>
                </div>
            </form>
        </div>
    </div>
@endsection
