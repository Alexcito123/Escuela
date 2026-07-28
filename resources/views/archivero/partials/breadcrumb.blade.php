<nav class="flex mb-6" aria-label="Breadcrumb">
    <ol class="inline-flex items-center gap-1.5 text-sm">
        <li>
            <a href="{{ route('archivero.index') }}" class="text-gray-400 hover:text-educlub transition-colors flex items-center gap-1.5">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"/>
                </svg>
                <span>Archivero</span>
            </a>
        </li>
        @isset($grade)
            <li class="flex items-center gap-1.5">
                <svg class="w-4 h-4 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
                <a href="{{ route('archivero.grade', $grade) }}" class="text-gray-400 hover:text-educlub transition-colors">
                    {{ $grade->name }}
                </a>
            </li>
        @endisset
        @isset($folder)
            <li class="flex items-center gap-1.5">
                <svg class="w-4 h-4 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
                <span class="text-gray-700 font-semibold">{{ $folder->name }}</span>
            </li>
        @endisset
    </ol>
</nav>
