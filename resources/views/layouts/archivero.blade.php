<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Archivo') - EduClub</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=nunito:400,500,600,700,800" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-50 font-sans antialiased" style="background-image: radial-gradient(circle at 0% 0%, rgba(79,195,232,0.10) 0%, transparent 45%), radial-gradient(circle at 100% 0%, rgba(126,211,160,0.10) 0%, transparent 45%), radial-gradient(circle at 50% 100%, rgba(255,200,117,0.09) 0%, transparent 50%);">
    <div class="min-h-screen flex">
        {{-- Sidebar --}}
        <div class="hidden lg:block w-64 shrink-0">
            <div class="fixed w-64 h-full bg-educlub overflow-y-auto" style="background-image: linear-gradient(to bottom, #4FC3E8 0%, #2FA5CE 55%, #5FBF88 130%);">
                <div class="flex items-center h-16 px-6 border-b border-white/10">
                    <a href="{{ route('dashboard') }}" class="flex items-center gap-2">
                        <svg class="w-8 h-8 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/>
                        </svg>
                        <span class="text-xl font-bold text-white">EduClub</span>
                    </a>
                </div>
<nav class="px-3 py-4 space-y-1">
                    <a href="{{ route('dashboard') }}" class="sidebar-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                        <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                        <span>Inicio</span>
                    </a>
                    <a href="{{ route('archivero.index') }}" class="sidebar-link {{ request()->routeIs('archivero.*') ? 'active' : '' }}">
                        <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"/></svg>
                        <span>Archivero</span>
                    </a>
                    <a href="{{ route('gastos.index') }}" class="sidebar-link {{ request()->routeIs('gastos.*') ? 'active' : '' }}">
                        <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                        <span>Gastos</span>
                    </a>
                    <a href="{{ route('imagenes.index') }}" class="sidebar-link {{ request()->is('formato-imagen*') ? 'active' : '' }}">
                        <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        <span>Formato de Imágenes</span>
                    </a>
                </nav>
            </div>
        </div>

        <div class="flex-1 flex flex-col min-w-0">
            <header class="bg-gradient-to-r from-educlub to-educlub-dark shadow-sm">
                <div class="flex items-center justify-between h-16 px-4 sm:px-6">
                    <div class="flex items-center gap-3">
                        <span class="text-lg font-bold text-white">@yield('title', 'Archivo')</span>
                    </div>
                    <div class="flex items-center gap-4">
                        <span class="text-sm text-white/80">{{ auth()->user()->name }}</span>
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit" class="text-sm text-white/80 hover:text-white flex items-center gap-1.5 transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                                Salir
                            </button>
                        </form>
                    </div>
                </div>
            </header>

            @if (session('success'))
                <div class="mx-4 sm:mx-6 mt-4">
                    <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-2xl flex items-center gap-2" role="alert">
                        <svg class="w-5 h-5 shrink-0 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        {{ session('success') }}
                    </div>
                </div>
            @endif

            @if (session('error'))
                <div class="mx-4 sm:mx-6 mt-4">
                    <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-2xl flex items-center gap-2" role="alert">
                        <svg class="w-5 h-5 shrink-0 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        {{ session('error') }}
                    </div>
                </div>
            @endif

            @if ($errors->any())
                <div class="mx-4 sm:mx-6 mt-4">
                    <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-2xl" role="alert">
                        <ul class="list-disc pl-5 text-sm">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif

            <main class="flex-1 p-4 sm:p-6 lg:p-8">
                @yield('content')
            </main>

            <footer class="border-t border-sky-100 bg-white/80 backdrop-blur-sm px-4 sm:px-6 py-4">
                <p class="text-center text-xs text-gray-400">&copy; {{ date('Y') }} EduClub. <span class="text-educlub/70 font-medium">Todos los derechos reservados.</span></p>
            </footer>
        </div>
    </div>
</body>
</html>
