@extends('layouts.app')

@section('title', 'Formato de Imágenes')

@section('page-title', 'Formato de Imágenes')

@section('content')

    <div x-data="{ preview: null, fileName: '', mostrarPreview(event) { const file = event.target.files[0]; if (file) { this.fileName = file.name; const reader = new FileReader(); reader.onload = (e) => { this.preview = e.target.result; }; reader.readAsDataURL(file); } } }">

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

            {{-- Form --}}
            <div class="card lg:col-span-2">
                <h3 class="text-lg font-bold text-gray-800 mb-1">Cambiar formato de imagen</h3>
                <p class="text-sm text-gray-500 mb-6">Sube una imagen y se convertirá a PDF en tamaño carta (8.5 x 11 pulgadas).</p>

                <form action="{{ route('imagenes.convert') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf

                    {{-- Image upload --}}
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Imagen</label>
                        <div class="relative border-2 border-dashed border-gray-300 rounded-2xl p-8 text-center hover:border-educlub/50 transition-colors">
                            <input type="file" name="imagen" id="imagen-input" accept="image/*" class="hidden" required @change="mostrarPreview">
                            <template x-if="!preview">
                                <div>
                                    <svg class="w-10 h-10 mx-auto text-gray-300 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                    <p class="text-sm text-gray-500 mb-1">Arrastra tu imagen aquí o</p>
                                    <label for="imagen-input" class="btn-primary text-sm !py-2 !px-4 cursor-pointer inline-flex">
                                        Seleccionar Imagen
                                    </label>
                                    <p class="text-xs text-gray-400 mt-2">Formatos: JPG, PNG, GIF, WebP, BMP - Máx. 10 MB</p>
                                </div>
                            </template>
                            <template x-if="preview">
                                <div>
                                    <img :src="preview" alt="Vista previa" class="max-h-64 mx-auto rounded-xl border border-gray-200 shadow-sm">
                                    <p class="text-sm font-medium text-gray-700 mt-3" x-text="fileName"></p>
                                    <label for="imagen-input" class="btn-primary text-sm !py-2 !px-4 cursor-pointer inline-flex mt-2">
                                        Cambiar Imagen
                                    </label>
                                    <p class="text-xs text-gray-400 mt-2">Formatos: JPG, PNG, GIF, WebP, BMP - Máx. 10 MB</p>
                                </div>
                            </template>
                        </div>
                        @error('imagen')
                            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Output config --}}
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div class="p-4 rounded-2xl bg-gray-50">
                            <p class="text-sm font-semibold text-gray-800">Formato de salida</p>
                            <p class="text-xs text-gray-400 mt-0.5">PDF</p>
                        </div>
                        <div class="p-4 rounded-2xl bg-gray-50">
                            <p class="text-sm font-semibold text-gray-800">Tamaño</p>
                            <p class="text-xs text-gray-400 mt-0.5">Carta (8.5 x 11 pulgadas)</p>
                        </div>
                    </div>

                    <button type="submit" class="btn-primary w-full sm:w-auto !py-3 !px-8 inline-flex items-center justify-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        Convertir a PDF
                    </button>
                </form>
            </div>

            {{-- Info side --}}
            <div class="space-y-6">
                <div class="card">
                    <h3 class="text-sm font-bold text-gray-800 mb-4">Detalles</h3>
                    <div class="space-y-3">
                        <div class="flex items-center justify-between p-3 rounded-xl bg-gray-50">
                            <div>
                                <p class="text-sm font-semibold text-gray-800">Formato</p>
                                <p class="text-xs text-gray-400 mt-0.5">PDF para imprimir y compartir.</p>
                            </div>
                            <span class="text-xs text-gray-400">.pdf</span>
                        </div>
                        <div class="flex items-center justify-between p-3 rounded-xl bg-gray-50">
                            <div>
                                <p class="text-sm font-semibold text-gray-800">Tamaño</p>
                                <p class="text-xs text-gray-400 mt-0.5">Carta: 8.5 x 11 pulgadas.</p>
                            </div>
                            <span class="text-xs text-gray-400">300 DPI</span>
                        </div>
                    </div>
                </div>

                <div class="card bg-orange-pastel/5 border-orange-pastel/20">
                    <div class="flex items-start gap-3">
                        <div class="w-8 h-8 bg-orange-pastel/10 rounded-xl flex items-center justify-center shrink-0">
                            <svg class="w-4 h-4 text-orange-pastel" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </div>
                        <p class="text-xs text-gray-600 leading-relaxed">La imagen se ajusta al tamaño carta manteniendo la proporción y se centra en la página.</p>
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection