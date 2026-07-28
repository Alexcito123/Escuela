<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Escuela') }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 dark:bg-gray-900 font-sans antialiased">
    <div class="min-h-screen flex flex-col">
        <nav class="bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16 items-center">
                    <div class="flex items-center space-x-2">
                        <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4" />
                        </svg>
                        <span class="text-xl font-bold text-gray-900 dark:text-white">Escuela</span>
                    </div>
                    <div class="flex items-center space-x-3">
                        @auth
                            <span class="text-sm text-gray-600 dark:text-gray-400">{{ auth()->user()->name }}</span>
                            <form method="POST" action="{{ route('logout') }}" class="inline">
                                @csrf
                                <button type="submit" class="text-sm text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-white">Cerrar sesión</button>
                            </form>
                        @else
                            <a href="{{ route('login') }}" class="text-sm text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white font-medium">Iniciar sesión</a>
                            <a href="{{ route('register') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition">Registrarse</a>
                        @endauth
                    </div>
                </div>
            </div>
        </nav>

        <main class="flex-1 flex items-center justify-center p-6">
            <div class="max-w-4xl w-full text-center">
                <div class="mb-12">
                    <svg class="w-16 h-16 text-blue-600 mx-auto mb-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4" />
                    </svg>
                    <h1 class="text-4xl font-bold text-gray-900 dark:text-white mb-4">Sistema de Gestión Escolar</h1>
                    <p class="text-lg text-gray-600 dark:text-gray-400 max-w-2xl mx-auto">
                        Administra archivos, alumnos y más desde un solo lugar.
                    </p>
                </div>

                @auth
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 max-w-2xl mx-auto">
                        <a href="{{ route('archivero.index') }}"
                           class="group bg-white dark:bg-gray-800 rounded-2xl shadow-sm hover:shadow-md border border-gray-200 dark:border-gray-700 p-8 transition-all hover:-translate-y-1">
                            <div class="w-16 h-16 bg-blue-100 dark:bg-blue-900 rounded-xl flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition">
                                <svg class="w-8 h-8 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4" />
                                </svg>
                            </div>
                            <h2 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">Archivero</h2>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Sube, descarga y organiza archivos escolares por grado y materia.</p>
                        </a>

                        <a href="{{ route('students.index') }}"
                           class="group bg-white dark:bg-gray-800 rounded-2xl shadow-sm hover:shadow-md border border-gray-200 dark:border-gray-700 p-8 transition-all hover:-translate-y-1">
                            <div class="w-16 h-16 bg-green-100 dark:bg-green-900 rounded-xl flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition">
                                <svg class="w-8 h-8 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </div>
                            <h2 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">Alumnos</h2>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Registra y administra la información de todos los alumnos.</p>
                        </a>
                    </div>
                @else
                    <div class="max-w-md mx-auto space-y-4">
                        <a href="{{ route('login') }}"
                           class="block w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-6 rounded-xl transition text-center">
                            Iniciar sesión
                        </a>
                        <p class="text-sm text-gray-500 dark:text-gray-400">
                            ¿No tienes cuenta?
                            <a href="{{ route('register') }}" class="text-blue-600 hover:text-blue-700 font-medium">Regístrate aquí</a>
                        </p>
                    </div>
                @endauth
            </div>
        </main>

        <footer class="bg-white dark:bg-gray-800 border-t border-gray-200 dark:border-gray-700 py-4">
            <p class="text-center text-sm text-gray-500 dark:text-gray-400">
                &copy; {{ date('Y') }} Sistema de Gestión Escolar. Todos los derechos reservados.
            </p>
        </footer>
    </div>
</body>
</html>
