@extends('layouts.archivero')

@section('title', 'Pago #' . $payment->id)

@section('content')
    <div class="flex items-center mb-6">
        <a href="{{ route('payments.index') }}" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300 mr-4">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
        </a>
        <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Pago #{{ $payment->id }}</h1>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="lg:col-span-1">
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-6 text-center">
                <div class="w-24 h-24 rounded-full bg-green-100 dark:bg-green-900 mx-auto mb-4 flex items-center justify-center">
                    <svg class="w-12 h-12 text-green-600 dark:text-green-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v12m-3-2.818l.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <h2 class="text-3xl font-bold text-gray-900 dark:text-white">${{ number_format($payment->monto, 2) }}</h2>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">{{ $payment->concepto }}</p>
                <div class="mt-4">
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium
                        {{ $payment->estado === 'Pagado' ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200' : '' }}
                        {{ $payment->estado === 'Pendiente' ? 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200' : '' }}
                        {{ $payment->estado === 'Cancelado' ? 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200' : '' }}">
                        {{ $payment->estado }}
                    </span>
                </div>
                <div class="mt-6 flex justify-center space-x-3">
                    <a href="{{ route('payments.edit', $payment) }}" class="bg-amber-600 hover:bg-amber-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition">Editar</a>
                    <form method="POST" action="{{ route('payments.destroy', $payment) }}" onsubmit="return confirm('¿Eliminar este pago?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition">Eliminar</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="lg:col-span-2 space-y-6">
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-6">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Detalles del Pago</h3>
                <dl class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <dt class="text-sm text-gray-500 dark:text-gray-400">Alumno</dt>
                        <dd class="text-sm font-medium text-gray-900 dark:text-white">
                            <a href="{{ route('payments.student', $payment->student) }}" class="text-blue-600 hover:text-blue-800 dark:text-blue-400">
                                {{ $payment->student->nombre_completo }}
                            </a>
                        </dd>
                    </div>
                    <div>
                        <dt class="text-sm text-gray-500 dark:text-gray-400">Grado</dt>
                        <dd class="text-sm font-medium text-gray-900 dark:text-white">{{ $payment->student->grade->name ?? '—' }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm text-gray-500 dark:text-gray-400">Concepto</dt>
                        <dd class="text-sm font-medium text-gray-900 dark:text-white">{{ $payment->concepto }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm text-gray-500 dark:text-gray-400">Monto</dt>
                        <dd class="text-sm font-medium text-gray-900 dark:text-white">${{ number_format($payment->monto, 2) }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm text-gray-500 dark:text-gray-400">Fecha</dt>
                        <dd class="text-sm font-medium text-gray-900 dark:text-white">{{ $payment->fecha->format('d/m/Y') }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm text-gray-500 dark:text-gray-400">Método de pago</dt>
                        <dd class="text-sm font-medium text-gray-900 dark:text-white">{{ $payment->metodo_pago }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm text-gray-500 dark:text-gray-400">Referencia</dt>
                        <dd class="text-sm font-medium text-gray-900 dark:text-white">{{ $payment->referencia ?? '—' }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm text-gray-500 dark:text-gray-400">Estado</dt>
                        <dd class="text-sm font-medium text-gray-900 dark:text-white">{{ $payment->estado }}</dd>
                    </div>
                    <div class="md:col-span-2">
                        <dt class="text-sm text-gray-500 dark:text-gray-400">Observaciones</dt>
                        <dd class="text-sm font-medium text-gray-900 dark:text-white">{{ $payment->observaciones ?? '—' }}</dd>
                    </div>
                </dl>
            </div>
        </div>
    </div>
@endsection
