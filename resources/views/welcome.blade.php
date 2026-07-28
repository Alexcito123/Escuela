<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>EduClub - Plataforma Educativa</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=nunito:400,500,600,700,800" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#F8FAFC] font-sans antialiased min-h-screen flex flex-col" style="background-image: radial-gradient(circle at 10% 30%, rgba(61, 175, 203, 0.06) 0%, transparent 50%), radial-gradient(circle at 90% 70%, rgba(127, 191, 122, 0.06) 0%, transparent 50%), radial-gradient(circle at 50% 50%, rgba(244, 178, 93, 0.04) 0%, transparent 50%);">

    <div class="fixed inset-0 pointer-events-none overflow-hidden">
        <svg class="absolute top-16 left-16 w-20 h-20 text-educlub/10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
        <svg class="absolute top-32 right-20 w-16 h-16 text-green-pastel/10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/></svg>
        <svg class="absolute bottom-32 left-20 w-14 h-14 text-orange-pastel/10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/></svg>
        <svg class="absolute bottom-20 right-32 w-12 h-12 text-pink-pastel/10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
        <div class="absolute top-1/4 left-1/3 w-96 h-96 border border-educlub/5 rounded-full"></div>
        <div class="absolute bottom-1/4 right-1/3 w-72 h-72 border border-green-pastel/5 rounded-full"></div>
    </div>

    <header class="relative z-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-20">
                <div class="flex items-center gap-2">
                    <svg class="w-8 h-8 text-educlub" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/>
                    </svg>
                    <span class="text-xl font-bold text-gray-800">EduClub</span>
                </div>
                <div class="flex items-center gap-3">
                    @auth
                        <a href="{{ route('dashboard') }}" class="btn-primary text-sm !py-2">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="text-sm font-medium text-gray-600 hover:text-gray-800 px-4 py-2 transition-colors">Iniciar Sesión</a>
                        <a href="{{ route('register') }}" class="btn-primary text-sm !py-2">Registrarse</a>
                    @endauth
                </div>
            </div>
        </div>
    </header>

    <main class="relative z-10 flex-1 flex items-center">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 lg:py-20">
            <div class="max-w-3xl">
                <div class="inline-flex items-center gap-2 bg-educlub/10 text-educlub text-sm font-semibold px-4 py-1.5 rounded-full mb-6">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                    Plataforma Educativa
                </div>
                <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold text-gray-900 leading-tight">
                    Bienvenido a
                    <span class="text-educlub">EduClub</span>
                </h1>
                <p class="text-lg sm:text-xl text-gray-500 mt-6 leading-relaxed max-w-2xl">
                    La plataforma educativa que conecta a docentes, padres y administradores en un solo lugar. Gestiona alumnos, comparte materiales y da seguimiento al progreso escolar.
                </p>
                <div class="flex flex-wrap gap-4 mt-10">
                    @auth
                        <a href="{{ route('dashboard') }}" class="btn-primary !py-3 !px-8 text-base">Ir al Dashboard</a>
                        <a href="{{ route('archivero.index') }}" class="btn-secondary !py-3 !px-8 text-base">Archivero</a>
                    @else
                        <a href="{{ route('register') }}" class="btn-primary !py-3 !px-8 text-base">Comenzar Ahora</a>
                        <a href="{{ route('login') }}" class="text-gray-600 hover:text-gray-800 font-medium !py-3 !px-6 inline-flex items-center gap-2 transition-colors">
                            Ya tengo cuenta
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </main>

    {{-- Features --}}
    <section class="relative z-10 bg-white/60 backdrop-blur-sm border-t border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
            <div class="text-center mb-12">
                <h2 class="text-2xl sm:text-3xl font-bold text-gray-800">Todo lo que necesitas en un solo lugar</h2>
                <p class="text-gray-500 mt-3">Herramientas diseñadas para la educación infantil</p>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 hover:shadow-md transition-all">
                    <div class="w-12 h-12 bg-educlub/10 rounded-2xl flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-educlub" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z"/></svg>
                    </div>
                    <h3 class="font-semibold text-gray-800 mb-2">Gestión de Alumnos</h3>
                    <p class="text-sm text-gray-500">Administra toda la información de tus estudiantes en un solo lugar.</p>
                </div>
                <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 hover:shadow-md transition-all">
                    <div class="w-12 h-12 bg-green-pastel/10 rounded-2xl flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-green-pastel" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"/></svg>
                    </div>
                    <h3 class="font-semibold text-gray-800 mb-2">Archivero Digital</h3>
                    <p class="text-sm text-gray-500">Sube, organiza y comparte material educativo con toda la comunidad.</p>
                </div>
                <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 hover:shadow-md transition-all">
                    <div class="w-12 h-12 bg-orange-pastel/10 rounded-2xl flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-orange-pastel" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                    </div>
                    <h3 class="font-semibold text-gray-800 mb-2">Reportes</h3>
                    <p class="text-sm text-gray-500">Genera reportes detallados del rendimiento académico y actividades.</p>
                </div>
                <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 hover:shadow-md transition-all">
                    <div class="w-12 h-12 bg-pink-pastel/10 rounded-2xl flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-pink-pastel" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                    </div>
                    <h3 class="font-semibold text-gray-800 mb-2">Comunicación</h3>
                    <p class="text-sm text-gray-500">Conecta con docentes, padres y administradores fácilmente.</p>
                </div>
            </div>
        </div>
    </section>

    <footer class="relative z-10 border-t border-gray-200 bg-white/40 backdrop-blur-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
            <div class="flex flex-col sm:flex-row items-center justify-between gap-2 text-sm text-gray-400">
                <p>&copy; {{ date('Y') }} EduClub. Todos los derechos reservados.</p>
                <p>Hecho con ❤️ para la educación</p>
            </div>
        </div>
    </footer>
</body>
</html>
