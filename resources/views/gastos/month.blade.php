@extends('layouts.archivero')

@section('title', $month->name)

@section('content')
    <div class="flex items-center gap-2 text-sm text-gray-400 mb-6">
        <a href="{{ route('gastos.index') }}" class="hover:text-orange-pastel transition-colors">Gastos</a>
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
        <span class="text-gray-600 font-medium">{{ $month->name }}</span>
    </div>

    <div x-data="{
        weekModal: false,
        editModal: false,
        editId: null,
        editName: '',
        weeks: @js($weeks->map(fn($w) => ['id' => $w->id, 'name' => $w->name])->values())
    }">
        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 mb-8">
            <div>
                <h1 class="text-2xl sm:text-3xl font-extrabold text-gray-800">{{ $month->name }}</h1>
                <p class="text-sm text-gray-400 mt-1">{{ $weeks->count() }} semana(s) disponible(s)</p>
            </div>
            <div class="flex items-center gap-3">
                <button @click="editModal = true; editId = null"
                        class="px-4 py-2.5 text-sm font-semibold text-orange-pastel border border-orange-pastel/30 hover:bg-orange-50 rounded-xl transition-all flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                    Editar Semanas
                </button>
                <button @click="weekModal = true"
                        class="btn-warning !py-2.5 !px-5 text-sm flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    Nueva Semana
                </button>
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @forelse ($weeks as $week)
                <div class="group relative bg-white rounded-2xl shadow-sm hover:shadow-lg border border-gray-100 transition-all duration-300 hover:-translate-y-1 hover:border-orange-pastel/30 overflow-hidden">
                    <div class="absolute top-0 right-0 w-24 h-24 bg-orange-pastel/10 rounded-full -translate-y-1/2 translate-x-1/2 group-hover:scale-150 transition-transform duration-500"></div>
                    <a href="{{ route('gastos.week', $week) }}" class="block relative p-6">
                        <div class="flex items-start gap-4">
                            <div class="shrink-0 w-14 h-14 bg-gradient-to-br from-orange-pastel to-orange-pastel-dark rounded-2xl flex items-center justify-center shadow-sm">
                                <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                            </div>
                            <div class="flex-1 min-w-0">
                                <h3 class="text-lg font-bold text-gray-800 truncate group-hover:text-orange-pastel transition-colors">{{ $week->name }}</h3>
                                @if ($week->date_range)
                                    <p class="text-xs text-gray-400 mt-1">{{ $week->date_range }}</p>
                                @endif
                                <p class="text-sm text-gray-400 mt-3 flex items-center gap-1.5">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                                    {{ $week->rows_count }} registros
                                </p>
                            </div>
                            <svg class="w-5 h-5 text-gray-300 group-hover:text-orange-pastel transition-all group-hover:translate-x-1 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </div>
                    </a>
                    <button type="button" @click="editId = {{ $week->id }}; editName = @js($week->name); editModal = true"
                            class="absolute top-3 right-3 z-10 p-2 text-gray-300 hover:text-orange-pastel hover:bg-orange-50 rounded-xl transition-all"
                            title="Editar semana">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                    </button>
                </div>
            @empty
                <div class="col-span-full text-center py-16">
                    <div class="w-20 h-20 bg-orange-50 rounded-3xl flex items-center justify-center mx-auto mb-4">
                        <svg class="w-10 h-10 text-orange-pastel" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-700 mb-1">No hay semanas</h3>
                    <p class="text-sm text-gray-400 mb-6">Este mes aún no tiene semanas. Crea la primera.</p>
                    <button @click="weekModal = true"
                            class="btn-warning !py-2.5 !px-6 text-sm">
                        Crear Primera Semana
                    </button>
                </div>
            @endforelse
        </div>

        {{-- Create Week Modal --}}
        <div x-show="weekModal" x-transition.opacity class="fixed inset-0 bg-black/40 z-50 overflow-y-auto p-4 flex items-center justify-center backdrop-blur-sm"
             @click.self="weekModal = false">
            <div class="bg-white rounded-3xl shadow-2xl w-full max-w-md p-8 relative">
                <button type="button" @click="weekModal = false" class="absolute top-4 right-4 text-gray-300 hover:text-gray-500 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-10 h-10 bg-orange-pastel/10 rounded-2xl flex items-center justify-center">
                        <svg class="w-5 h-5 text-orange-pastel" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-bold text-gray-800">Nueva Semana</h3>
                        <p class="text-xs text-gray-400">en {{ $month->name }}</p>
                    </div>
                </div>
                <form method="POST" action="{{ route('gastos.storeWeek') }}"
                      @submit="weekModal = false">
                    @csrf
                    <input type="hidden" name="gasto_month_id" value="{{ $month->id }}">
                    <div class="mb-4">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Nombre de la semana</label>
                        <input type="text" name="name" required maxlength="255"
                               class="input-field"
                               placeholder="Ej: Semana 1">
                    </div>
                    <div class="mb-6">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Rango de fechas <span class="text-gray-400 font-normal">(opcional)</span></label>
                        <input type="text" name="date_range" maxlength="255"
                               class="input-field"
                               placeholder="Ej: 13 de Julio al 17 de Julio 2026">
                    </div>
                    <div class="flex justify-end gap-3">
                        <button type="button" @click="weekModal = false"
                                class="px-5 py-2.5 text-sm font-medium text-gray-600 hover:text-gray-800 transition-colors rounded-xl hover:bg-gray-100">
                            Cancelar
                        </button>
                        <button type="submit" class="btn-warning !py-2.5 !px-5 text-sm">
                            Crear Semana
                        </button>
                    </div>
                </form>
            </div>
        </div>

        {{-- Edit Week Modal --}}
        <div x-show="editModal" x-transition.opacity class="fixed inset-0 bg-black/40 z-50 overflow-y-auto p-4 flex items-center justify-center backdrop-blur-sm"
             @click.self="editModal = false">
            <div class="bg-white rounded-3xl shadow-2xl w-full max-w-lg p-8 relative">
                <button type="button" @click="editModal = false" class="absolute top-4 right-4 text-gray-300 hover:text-gray-500 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-10 h-10 bg-orange-pastel/10 rounded-2xl flex items-center justify-center">
                        <svg class="w-5 h-5 text-orange-pastel" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-bold text-gray-800">Editar Semanas</h3>
                        <p class="text-xs text-gray-400" x-text="editId ? 'Modificando: ' + editName : 'Selecciona una semana para modificar'"></p>
                    </div>
                </div>

                <div x-show="!editId">
                    <div x-show="weeks.length === 0" class="text-center py-8">
                        <p class="text-sm text-gray-400">Este mes aún no tiene semanas.</p>
                    </div>
                    <div x-show="weeks.length > 0" class="max-h-64 overflow-y-auto space-y-2 mb-2 pr-1">
                        <template x-for="w in weeks" :key="w.id">
                            <button type="button" @click="editId = w.id; editName = w.name"
                                    class="w-full text-left px-4 py-3 rounded-xl border border-gray-200 hover:border-orange-pastel hover:bg-orange-pastel/5 transition-all flex items-center justify-between group">
                                <span class="font-medium text-gray-700 group-hover:text-gray-900" x-text="w.name"></span>
                                <svg class="w-4 h-4 text-gray-300 group-hover:text-orange-pastel shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                            </button>
                        </template>
                    </div>
                </div>

                <div x-show="editId">
                    <form method="POST" :action="'{{ url('gastos/semana') }}' + '/' + editId"
                          @submit="editModal = false">
                        @csrf
                        @method('PUT')
                        <div class="mb-6">
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Nuevo nombre de la semana</label>
                            <input type="text" name="name" x-model="editName" required maxlength="255"
                                   class="input-field"
                                   placeholder="Nuevo nombre">
                        </div>
                        <div class="flex justify-between gap-3">
                            <button type="button" @click="editId = null"
                                    class="px-4 py-2.5 text-sm font-medium text-gray-500 hover:text-gray-700 transition-colors rounded-xl hover:bg-gray-100 flex items-center gap-1.5">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                                Volver a la lista
                            </button>
                            <button type="submit" class="btn-warning !py-2.5 !px-5 text-sm">
                                Guardar Cambios
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
