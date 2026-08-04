@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Paginación">
        <div class="flex gap-2 items-center justify-between sm:hidden">
            @if ($paginator->onFirstPage())
                <span class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-400 bg-white border border-[#F2ECDD] cursor-not-allowed rounded-xl">
                    Anterior
                </span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" rel="prev" class="inline-flex items-center px-4 py-2 text-sm font-medium text-educlub bg-white border border-[#F2ECDD] rounded-xl hover:bg-educlub/10 transition">
                    Anterior
                </a>
            @endif

            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" rel="next" class="inline-flex items-center px-4 py-2 text-sm font-medium text-educlub bg-white border border-[#F2ECDD] rounded-xl hover:bg-educlub/10 transition">
                    Siguiente
                </a>
            @else
                <span class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-400 bg-white border border-[#F2ECDD] cursor-not-allowed rounded-xl">
                    Siguiente
                </span>
            @endif
        </div>

        <div class="hidden sm:flex-1 sm:flex sm:gap-2 sm:items-center sm:justify-between">
            <div>
                <p class="text-sm text-gray-500">
                    Mostrando
                    @if ($paginator->firstItem())
                        <span class="font-semibold text-educlub">{{ $paginator->firstItem() }}</span>
                        a
                        <span class="font-semibold text-educlub">{{ $paginator->lastItem() }}</span>
                    @else
                        {{ $paginator->count() }}
                    @endif
                    de
                    <span class="font-semibold text-educlub">{{ $paginator->total() }}</span>
                    resultados
                </p>
            </div>

            <div class="flex items-center gap-1.5">
                @if ($paginator->onFirstPage())
                    <span aria-disabled="true" aria-label="Página anterior"
                          class="inline-flex items-center justify-center w-9 h-9 text-sm font-medium text-gray-300 bg-white border border-[#F2ECDD] cursor-not-allowed rounded-xl">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                        </svg>
                    </span>
                @else
                    <a href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="Página anterior"
                       class="inline-flex items-center justify-center w-9 h-9 text-sm font-medium text-gray-500 bg-white border border-[#F2ECDD] rounded-xl hover:bg-educlub/10 hover:text-educlub hover:border-educlub/30 transition">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                        </svg>
                    </a>
                @endif

                @foreach ($elements as $element)
                    @if (is_string($element))
                        <span aria-disabled="true" class="inline-flex items-center justify-center w-9 h-9 text-sm font-medium text-gray-400 cursor-default rounded-xl">
                            {{ $element }}
                        </span>
                    @endif

                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <span aria-current="page"
                                      class="inline-flex items-center justify-center w-9 h-9 text-sm font-bold text-white bg-educlub shadow-md shadow-educlub/30 rounded-xl">
                                    {{ $page }}
                                </span>
                            @else
                                <a href="{{ $url }}" aria-label="Ir a la página {{ $page }}"
                                   class="inline-flex items-center justify-center w-9 h-9 text-sm font-medium text-gray-600 bg-white border border-[#F2ECDD] rounded-xl hover:bg-educlub/10 hover:text-educlub hover:border-educlub/30 transition">
                                    {{ $page }}
                                </a>
                            @endif
                        @endforeach
                    @endif
                @endforeach

                @if ($paginator->hasMorePages())
                    <a href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="Página siguiente"
                       class="inline-flex items-center justify-center w-9 h-9 text-sm font-medium text-gray-500 bg-white border border-[#F2ECDD] rounded-xl hover:bg-educlub/10 hover:text-educlub hover:border-educlub/30 transition">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                        </svg>
                    </a>
                @else
                    <span aria-disabled="true" aria-label="Página siguiente"
                          class="inline-flex items-center justify-center w-9 h-9 text-sm font-medium text-gray-300 bg-white border border-[#F2ECDD] cursor-not-allowed rounded-xl">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                        </svg>
                    </span>
                @endif
            </div>
        </div>
    </nav>
@endif
