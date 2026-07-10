<nav class="flex mb-6 text-sm" aria-label="Breadcrumb">
    <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
        <li class="inline-flex items-center">
            <a href="{{ route('archivero.index') }}" class="text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-white">
                <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z" />
                </svg>
                Archivero
            </a>
        </li>
        @isset($grade)
            <li>
                <span class="mx-1 text-gray-400">/</span>
                <a href="{{ route('archivero.grade', $grade) }}" class="text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-white ms-1">
                    {{ $grade->name }}
                </a>
            </li>
        @endisset
        @isset($folder)
            <li aria-current="page">
                <span class="mx-1 text-gray-400">/</span>
                <span class="text-gray-700 dark:text-gray-200 ms-1 font-medium">{{ $folder->name }}</span>
            </li>
        @endisset
    </ol>
</nav>
