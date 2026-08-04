<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Iniciar Sesión - EduClub</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=nunito:400,500,600,700,800" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased min-h-screen flex items-center justify-center p-4" style="background-image: radial-gradient(circle at 10% 20%, rgba(74, 154, 147, 0.07) 0%, transparent 50%), radial-gradient(circle at 90% 80%, rgba(134, 185, 142, 0.07) 0%, transparent 50%), radial-gradient(circle at 50% 50%, rgba(217, 160, 107, 0.05) 0%, transparent 50%), radial-gradient(circle at 85% 15%, rgba(222, 161, 162, 0.05) 0%, transparent 40%);">

    {{-- Decorative Elements --}}
    <div class="fixed inset-0 pointer-events-none overflow-hidden">
        <svg class="absolute top-10 left-10 w-16 h-16 text-educlub/10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
        <svg class="absolute top-20 right-20 w-12 h-12 text-orange-pastel/10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/></svg>
        <svg class="absolute bottom-20 left-20 w-14 h-14 text-green-pastel/10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/></svg>
        <svg class="absolute bottom-10 right-20 w-10 h-10 text-pink-pastel/10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>

        {{-- Floating circles --}}
        <div class="absolute top-1/4 left-1/4 w-64 h-64 border border-educlub/5 rounded-full animate-pulse"></div>
        <div class="absolute bottom-1/4 right-1/4 w-48 h-48 border border-green-pastel/5 rounded-full animate-pulse" style="animation-delay: 1s;"></div>
        <div class="absolute top-1/3 right-1/3 w-32 h-32 border border-orange-pastel/5 rounded-full animate-pulse" style="animation-delay: 2s;"></div>
    </div>

    {{-- Login Card --}}
    <div class="relative w-full max-w-md">

        {{-- Header --}}
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-20 h-20 bg-educlub rounded-3xl shadow-lg mb-5">
                <svg class="w-10 h-10 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/>
                </svg>
            </div>
            <h1 class="text-3xl font-extrabold text-gray-800">EduClub</h1>
            <p class="text-gray-500 mt-2">Plataforma Educativa</p>
        </div>

        {{-- Form --}}
        <div class="bg-white rounded-3xl shadow-xl shadow-gray-200/50 p-8 sm:p-10 border border-gray-100">
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="mb-5">
                    <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">Correo Electrónico</label>
                    <div class="relative">
                        <svg class="input-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                        <input type="email" name="email" id="email" value="{{ old('email') }}"
                            class="input-field pl-11 @error('email') border-red-300 focus:ring-red-300 focus:border-red-300 @enderror"
                            placeholder="tu@correo.com" required autofocus>
                    </div>
                    @error('email')
                        <p class="mt-1.5 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="password" class="block text-sm font-semibold text-gray-700 mb-2">Contraseña</label>
                    <div class="relative">
                        <svg class="input-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                        </svg>
                        <input type="password" name="password" id="password"
                            class="input-field pl-11 @error('password') border-red-300 focus:ring-red-300 focus:border-red-300 @enderror"
                            placeholder="••••••••" required>
                    </div>
                    @error('password')
                        <p class="mt-1.5 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center justify-between mb-8">
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="checkbox" name="remember" id="remember"
                            class="w-4 h-4 rounded-lg border-gray-300 text-educlub focus:ring-educlub/30">
                        <span class="text-sm text-gray-600">Recordarme</span>
                    </label>
                    <a href="#" class="text-sm text-educlub hover:text-educlub-dark font-medium transition-colors">¿Olvidaste tu contraseña?</a>
                </div>

                <button type="submit" class="btn-primary w-full !py-3 text-base">
                    Iniciar Sesión
                </button>
            </form>

            <div class="mt-8 pt-6 border-t border-gray-100 text-center">
                <p class="text-sm text-gray-500">
                    ¿No tienes cuenta?
                    <a href="{{ route('register') }}" class="text-educlub hover:text-educlub-dark font-semibold transition-colors">Regístrate</a>
                </p>
            </div>
        </div>

        {{-- Footer --}}
        <p class="text-center text-xs text-gray-400 mt-8">&copy; {{ date('Y') }} EduClub. Todos los derechos reservados.</p>
    </div>

</body>
</html>
