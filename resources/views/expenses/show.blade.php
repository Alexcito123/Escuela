@extends('layouts.archivero')

@section('title', $expense->concepto)

@section('content')
    <div class="flex items-center mb-6">
        <a href="{{ route('expenses.index') }}" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300 mr-4">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
        </a>
        <h1 class="text-2xl font-bold text-gray-900 dark:text-white">{{ $expense->concepto }}</h1>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="lg:col-span-1">
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-6 text-center">
                <div class="w-24 h-24 rounded-full bg-red-100 dark:bg-red-900 mx-auto mb-4 flex items-center justify-center">
                    <svg class="w-12 h-12 text-red-600 dark:text-red-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <h2 class="text-3xl font-bold text-gray-900 dark:text-white">${{ number_format($expense->monto, 2) }}</h2>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">{{ $expense->categoria }}</p>
                <div class="mt-6 flex justify-center space-x-3">
                    <a href="{{ route('expenses.edit', $expense) }}" class="bg-amber-600 hover:bg-amber-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition">Editar</a>
                    <form method="POST" action="{{ route('expenses.destroy', $expense) }}" onsubmit="return confirm('¿Eliminar este gasto?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition">Eliminar</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="lg:col-span-2 space-y-6">
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-6">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Detalles del Gasto</h3>
                <dl class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <dt class="text-sm text-gray-500 dark:text-gray-400">Concepto</dt>
                        <dd class="text-sm font-medium text-gray-900 dark:text-white">{{ $expense->concepto }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm text-gray-500 dark:text-gray-400">Categoría</dt>
                        <dd class="text-sm font-medium text-gray-900 dark:text-white">{{ $expense->categoria }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm text-gray-500 dark:text-gray-400">Monto</dt>
                        <dd class="text-sm font-medium text-gray-900 dark:text-white">${{ number_format($expense->monto, 2) }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm text-gray-500 dark:text-gray-400">Fecha</dt>
                        <dd class="text-sm font-medium text-gray-900 dark:text-white">{{ $expense->fecha->format('d/m/Y') }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm text-gray-500 dark:text-gray-400">Proveedor</dt>
                        <dd class="text-sm font-medium text-gray-900 dark:text-white">{{ $expense->proveedor ?? '—' }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm text-gray-500 dark:text-gray-400">Método de pago</dt>
                        <dd class="text-sm font-medium text-gray-900 dark:text-white">{{ $expense->metodo_pago }}</dd>
                    </div>
                    <div class="md:col-span-2">
                        <dt class="text-sm text-gray-500 dark:text-gray-400">Observaciones</dt>
                        <dd class="text-sm font-medium text-gray-900 dark:text-white">{{ $expense->observaciones ?? '—' }}</dd>
                    </div>
                </dl>
            </div>
        </div>
    </div>
@endsection
