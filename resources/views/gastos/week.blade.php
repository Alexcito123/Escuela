@extends('layouts.archivero')

@section('title', $week->name . ' - Gastos')

@section('content')
    <div class="flex items-center gap-2 text-sm text-gray-400 mb-6">
        <a href="{{ route('gastos.index') }}" class="hover:text-orange-pastel transition-colors">Gastos</a>
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
        <a href="{{ route('gastos.month', $week->gastoMonth) }}" class="hover:text-orange-pastel transition-colors">{{ $week->gastoMonth->name }}</a>
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
        <span class="text-gray-600 font-medium">{{ $week->name }}</span>
    </div>

    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 mb-8">
        <div>
            <h1 class="text-2xl sm:text-3xl font-extrabold text-gray-800">{{ $week->name }}</h1>
            @if ($week->date_range)
                <p class="text-sm text-gray-400 mt-1">{{ $week->date_range }}</p>
            @endif
            <p class="text-sm text-gray-400 mt-1">{{ $rows->count() }} registro(s)</p>
        </div>
        <div class="flex items-center gap-2">
            <form method="POST" action="{{ route('gastos.destroyWeek', $week) }}"
                  onsubmit="return confirm('¿Eliminar esta semana y todos sus registros?')" class="inline">
                @csrf @method('DELETE')
                <button type="submit" class="px-4 py-2.5 text-sm font-medium text-red-500 bg-white border border-red-200 rounded-xl hover:bg-red-50 transition-all flex items-center gap-1.5">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                    Eliminar
                </button>
            </form>
        </div>
    </div>

    <style>
        .input-dinero { padding-left: 1.5rem; }
        .input-dinero-ico {
            position: absolute; left: 0.65rem; top: 50%; transform: translateY(-50%);
            font-size: 0.875rem; color: #9ca3af; font-weight: 500; pointer-events: none;
            opacity: 0; transition: opacity 0.15s;
        }
        .input-group-dinero { position: relative; }
        .input-dinero-ico.visible { opacity: 1; }
    </style>

    <form method="POST" action="{{ route('gastos.saveRows', $week) }}" id="formGastos">
        @csrf
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full" id="tablaGastos">
                    <thead>
                        <tr class="bg-orange-pastel text-white text-sm">
                            <th class="text-left py-3.5 px-4 font-semibold w-10">#</th>
                            <th class="text-left py-3.5 px-4 font-semibold">Alumnos</th>
                            <th class="text-left py-3.5 px-4 font-semibold w-36">Pago Semanal</th>
                            <th class="text-left py-3.5 px-4 font-semibold w-36">Mensual</th>
                            <th class="text-left py-3.5 px-4 font-semibold">Columna 1</th>
                            <th class="text-left py-3.5 px-4 font-semibold w-36">Gastos Semana</th>
                            <th class="text-right py-3.5 px-4 font-semibold w-24">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100" id="bodyGastos">
                        @foreach ($rows as $i => $row)
                            <tr class="bg-white hover:bg-orange-50/30 transition-colors gasto-row">
                                <td class="py-2 px-4 text-sm text-gray-400">{{ $i + 1 }}</td>
                                <td class="py-2 px-4">
                                    <input type="hidden" name="rows[{{ $i }}][id]" value="{{ $row->id }}">
                                    <input type="text" name="rows[{{ $i }}][alumno]" value="{{ $row->alumno }}"
                                           placeholder="Nombre del alumno"
                                           class="w-full rounded-lg border border-gray-200 px-3 py-2 text-sm focus:ring-2 focus:ring-orange-pastel/30 focus:border-orange-pastel outline-none transition-all">
                                </td>
                                <td class="py-2 px-4">
                                    <div class="input-group-dinero">
                                        <span class="input-dinero-ico {{ $row->pago_semanal ? 'visible' : '' }}" data-dinero>$</span>
                                        <input type="text" name="rows[{{ $i }}][pago_semanal]" value="{{ $row->pago_semanal }}"
                                               placeholder="0.00"
                                               oninput="toggleDinero(this)"
                                               class="input-dinero w-full rounded-lg border border-gray-200 px-3 py-2 text-sm focus:ring-2 focus:ring-orange-pastel/30 focus:border-orange-pastel outline-none transition-all">
                                    </div>
                                </td>
                                <td class="py-2 px-4">
                                    <div class="input-group-dinero">
                                        <span class="input-dinero-ico {{ $row->mensual ? 'visible' : '' }}" data-dinero>$</span>
                                        <input type="text" name="rows[{{ $i }}][mensual]" value="{{ $row->mensual }}"
                                               placeholder="0.00"
                                               oninput="toggleDinero(this)"
                                               class="input-dinero w-full rounded-lg border border-gray-200 px-3 py-2 text-sm focus:ring-2 focus:ring-orange-pastel/30 focus:border-orange-pastel outline-none transition-all">
                                    </div>
                                </td>
                                <td class="py-2 px-4">
                                    <input type="text" name="rows[{{ $i }}][columna1]" value="{{ $row->columna1 }}"
                                           placeholder=""
                                           class="w-full rounded-lg border border-gray-200 px-3 py-2 text-sm focus:ring-2 focus:ring-orange-pastel/30 focus:border-orange-pastel outline-none transition-all">
                                </td>
                                <td class="py-2 px-4">
                                    <div class="input-group-dinero">
                                        <span class="input-dinero-ico {{ $row->gastos_semana ? 'visible' : '' }}" data-dinero>$</span>
                                        <input type="text" name="rows[{{ $i }}][gastos_semana]" value="{{ $row->gastos_semana }}"
                                               placeholder="0.00"
                                               oninput="toggleDinero(this)"
                                               class="input-dinero w-full rounded-lg border border-gray-200 px-3 py-2 text-sm focus:ring-2 focus:ring-orange-pastel/30 focus:border-orange-pastel outline-none transition-all">
                                    </div>
                                </td>
                                <td class="py-2 px-4 text-right">
                                    <button type="button" onclick="eliminarFila(this)" class="p-2 text-gray-300 hover:text-red-500 hover:bg-red-50 rounded-xl transition-all" title="Eliminar fila">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot id="footTotales">
                        <tr class="bg-orange-50/60 border-t-2 border-orange-pastel text-sm font-semibold text-gray-700">
                            <td colspan="2" class="py-3 px-4 text-right">TOTAL</td>
                            <td class="py-3 px-4"><span id="totalPagoSemanal">0.00</span></td>
                            <td></td>
                            <td></td>
                            <td class="py-3 px-4"><span id="totalGastosSemana">0.00</span></td>
                            <td></td>
                        </tr>
                    </tfoot>
                </table>
            </div>

            <div class="border-t border-gray-100 bg-gray-50 px-4 py-4">
                <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                    <button type="button" onclick="agregarFila()"
                            class="flex items-center gap-2 text-sm font-medium text-orange-pastel hover:text-orange-pastel-dark transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                        Agregar fila
                    </button>
                    <button type="submit" class="btn-warning !py-2.5 !px-6 text-sm flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        Guardar
                    </button>
                </div>
            </div>
        </div>
    </form>

    <script>
        let rowIndex = {{ $rows->count() }};

        function toggleDinero(input) {
            const span = input.parentElement.querySelector('[data-dinero]');
            if (span) {
                span.classList.toggle('visible', input.value.trim() !== '');
            }
            actualizarTotales();
        }

        function actualizarTotales() {
            let totalPago = 0;
            let totalGastos = 0;
            document.querySelectorAll('#bodyGastos tr:not(.hidden)').forEach(row => {
                const pago = parseFloat(row.querySelector('input[name*="[pago_semanal]"]')?.value);
                const gastos = parseFloat(row.querySelector('input[name*="[gastos_semana]"]')?.value);
                if (!isNaN(pago)) totalPago += pago;
                if (!isNaN(gastos)) totalGastos += gastos;
            });
            document.getElementById('totalPagoSemanal').textContent = totalPago.toFixed(2);
            document.getElementById('totalGastosSemana').textContent = totalGastos.toFixed(2);
        }

        document.addEventListener('DOMContentLoaded', actualizarTotales);

        function agregarFila() {
            const tbody = document.getElementById('bodyGastos');
            const tr = document.createElement('tr');
            tr.className = 'bg-white hover:bg-orange-50/30 transition-colors gasto-row';
            tr.innerHTML = `
                <td class="py-2 px-4 text-sm text-gray-400">${rowIndex + 1}</td>
                <td class="py-2 px-4">
                    <input type="text" name="rows[${rowIndex}][alumno]" value=""
                           placeholder="Nombre del alumno"
                           class="w-full rounded-lg border border-gray-200 px-3 py-2 text-sm focus:ring-2 focus:ring-orange-pastel/30 focus:border-orange-pastel outline-none transition-all">
                </td>
                <td class="py-2 px-4">
                    <div class="input-group-dinero">
                        <span class="input-dinero-ico" data-dinero>$</span>
                        <input type="text" name="rows[${rowIndex}][pago_semanal]" value=""
                               placeholder="0.00" oninput="toggleDinero(this)"
                               class="input-dinero w-full rounded-lg border border-gray-200 px-3 py-2 text-sm focus:ring-2 focus:ring-orange-pastel/30 focus:border-orange-pastel outline-none transition-all">
                    </div>
                </td>
                <td class="py-2 px-4">
                    <div class="input-group-dinero">
                        <span class="input-dinero-ico" data-dinero>$</span>
                        <input type="text" name="rows[${rowIndex}][mensual]" value=""
                               placeholder="0.00" oninput="toggleDinero(this)"
                               class="input-dinero w-full rounded-lg border border-gray-200 px-3 py-2 text-sm focus:ring-2 focus:ring-orange-pastel/30 focus:border-orange-pastel outline-none transition-all">
                    </div>
                </td>
                <td class="py-2 px-4">
                    <input type="text" name="rows[${rowIndex}][columna1]" value=""
                           placeholder=""
                           class="w-full rounded-lg border border-gray-200 px-3 py-2 text-sm focus:ring-2 focus:ring-orange-pastel/30 focus:border-orange-pastel outline-none transition-all">
                </td>
                <td class="py-2 px-4">
                    <div class="input-group-dinero">
                        <span class="input-dinero-ico" data-dinero>$</span>
                        <input type="text" name="rows[${rowIndex}][gastos_semana]" value=""
                               placeholder="0.00" oninput="toggleDinero(this)"
                               class="input-dinero w-full rounded-lg border border-gray-200 px-3 py-2 text-sm focus:ring-2 focus:ring-orange-pastel/30 focus:border-orange-pastel outline-none transition-all">
                    </div>
                </td>
                <td class="py-2 px-4 text-right">
                    <button type="button" onclick="eliminarFila(this)" class="p-2 text-gray-300 hover:text-red-500 hover:bg-red-50 rounded-xl transition-all" title="Eliminar fila">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                    </button>
                </td>
            `;
            tbody.appendChild(tr);
            rowIndex++;

            tr.querySelector('input[name*="alumno"]').focus();
            renumerarFilas();
            actualizarTotales();
        }

        function eliminarFila(btn) {
            const row = btn.closest('tr');
            const inputId = row.querySelector('input[type="hidden"]');
            if (inputId) {
                inputId.name = '_delete[]';
            }
            row.classList.add('hidden');
            row.querySelectorAll('input').forEach(i => i.disabled = true);
            renumerarFilas();
            actualizarTotales();
        }

        function renumerarFilas() {
            const rows = document.querySelectorAll('#bodyGastos tr:not(.hidden)');
            rows.forEach((row, i) => {
                row.querySelector('td:first-child').textContent = i + 1;
            });
        }
    </script>
@endsection
