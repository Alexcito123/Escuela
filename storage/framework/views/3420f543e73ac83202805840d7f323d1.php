<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title><?php echo $__env->yieldContent('title', 'EduClub'); ?> - <?php echo e(config('app.name', 'EduClub')); ?></title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=nunito:400,500,600,700,800" rel="stylesheet" />
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
</head>
<body class="bg-slate-50 font-sans antialiased" x-data="{ sidebarOpen: false }" style="background-image: radial-gradient(circle at 0% 0%, rgba(79,195,232,0.10) 0%, transparent 45%), radial-gradient(circle at 100% 0%, rgba(126,211,160,0.10) 0%, transparent 45%), radial-gradient(circle at 50% 100%, rgba(255,200,117,0.09) 0%, transparent 50%);">

    <div class="min-h-screen flex">

        
        <aside
            class="fixed inset-y-0 left-0 z-50 w-64 bg-gradient-to-b from-educlub via-educlub to-educlub-dark transform transition-transform duration-300 lg:translate-x-0 lg:static lg:inset-auto"
            style="background-image: linear-gradient(to bottom, #4FC3E8 0%, #2FA5CE 55%, #5FBF88 130%);"
            :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
        >
            <div class="flex items-center justify-between h-16 px-6 border-b border-white/10">
                <a href="<?php echo e(route('dashboard')); ?>" class="flex items-center gap-2">
                    <svg class="w-8 h-8 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/>
                    </svg>
                    <span class="text-xl font-bold text-white">EduClub</span>
                </a>
                <button @click="sidebarOpen = false" class="lg:hidden text-white/60 hover:text-white">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>

            <nav class="px-3 py-4 space-y-1">
                <a href="<?php echo e(route('dashboard')); ?>" class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-white/80 hover:text-white hover:bg-white/15 transition-all <?php if(request()->routeIs('dashboard')): ?> bg-white/25 text-white font-medium backdrop-blur-sm <?php endif; ?>">
                    <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                    <span>Inicio</span>
                </a>
<a href="<?php echo e(route('archivero.index')); ?>" class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-white/80 hover:text-white hover:bg-white/15 transition-all <?php if(request()->is('archivero*')): ?> bg-white/25 text-white font-medium backdrop-blur-sm <?php endif; ?>">
                    <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"/></svg>
                    <span>Archivero</span>
                </a>
                <a href="<?php echo e(route('gastos.index')); ?>" class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-white/80 hover:text-white hover:bg-white/15 transition-all <?php if(request()->is('gastos*')): ?> bg-white/25 text-white font-medium backdrop-blur-sm <?php endif; ?>">
                    <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                    <span>Gastos</span>
                </a>
                <a href="<?php echo e(route('imagenes.index')); ?>" class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-white/80 hover:text-white hover:bg-white/15 transition-all <?php if(request()->is('formato-imagen*')): ?> bg-white/25 text-white font-medium backdrop-blur-sm <?php endif; ?>">
                    <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    <span>Formato de Imágenes</span>
                </a>
            </nav>

            <div class="absolute bottom-0 left-0 right-0 p-4 border-t border-white/10">
                <div class="flex items-center gap-3 text-white/70">
                    <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                    <span class="text-xs">EduClub v1.0</span>
                </div>
            </div>
        </aside>

        
        <div
            class="fixed inset-0 bg-black/30 z-40 lg:hidden"
            x-show="sidebarOpen"
            @click="sidebarOpen = false"
            x-cloak
        ></div>

        
        <div class="flex-1 flex flex-col min-w-0">

            
            <header class="shadow-sm" style="background-image: linear-gradient(to bottom, #4FC3E8 0%, #2FA5CE 55%, #5FBF88 130%);">
                <div class="flex items-center justify-between h-16 px-4 sm:px-6">
                    <div class="flex items-center gap-3">
                        <button @click="sidebarOpen = true" class="lg:hidden text-white/80 hover:text-white">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                            </svg>
                        </button>
                        <h1 class="text-lg font-bold text-white truncate"><?php echo $__env->yieldContent('page-title', 'Dashboard'); ?></h1>
                    </div>

                    <div class="flex items-center gap-4">
                        <button class="relative text-white/80 hover:text-white transition-colors">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                            </svg>
                            <span class="absolute -top-1 -right-1 w-4 h-4 bg-pink-pastel rounded-full text-[10px] font-bold text-white flex items-center justify-center">3</span>
                        </button>

                        <div class="relative" x-data="{ open: false }">
                            <button @click="open = !open" class="flex items-center gap-2 rounded-xl border border-white/10 bg-white/10 px-2.5 py-1.5 text-white/90 shadow-sm transition-all hover:bg-white/15 hover:text-white">
                                <div class="w-8 h-8 rounded-full bg-white/15 flex items-center justify-center overflow-hidden ring-1 ring-white/15">
                                    <?php if(auth()->user()->avatar_url): ?>
                                        <img src="<?php echo e(auth()->user()->avatar_url); ?>" alt="Foto de perfil" class="w-full h-full object-cover">
                                    <?php else: ?>
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                        </svg>
                                    <?php endif; ?>
                                </div>
                                <span class="text-sm font-medium hidden sm:block"><?php echo e(auth()->user()->name ?? 'Usuario'); ?></span>
                                <svg class="w-4 h-4 hidden sm:block" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </button>
                            <div x-show="open" @click.away="open = false" x-cloak class="absolute right-0 mt-2 w-64 overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-xl z-50">
                                <div class="border-b border-slate-200 px-4 py-3 flex items-center gap-3 bg-slate-50">
                                    <div class="w-9 h-9 rounded-full bg-gradient-to-br from-educlub to-green-pastel flex items-center justify-center overflow-hidden shrink-0 ring-1 ring-white/15">
                                        <?php if(auth()->user()->avatar_url): ?>
                                            <img src="<?php echo e(auth()->user()->avatar_url); ?>" alt="Foto de perfil" class="w-full h-full object-cover">
                                        <?php else: ?>
                                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                                        <?php endif; ?>
                                    </div>
                                    <div class="min-w-0">
                                        <p class="text-sm font-semibold truncate text-slate-800"><?php echo e(auth()->user()->name ?? 'Usuario'); ?></p>
                                        <p class="text-xs truncate text-slate-500"><?php echo e(auth()->user()->email ?? ''); ?></p>
                                    </div>
                                </div>
                                <div class="p-2">
                                    <a href="<?php echo e(route('perfil.show')); ?>" class="flex items-center gap-2 rounded-xl px-3 py-2 text-sm font-medium text-slate-700 transition-all duration-200 hover:bg-educlub/10 hover:text-educlub">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                                        Mi Perfil
                                    </a>
                                    <form method="POST" action="<?php echo e(route('logout')); ?>" class="mt-1">
                                        <?php echo csrf_field(); ?>
                                        <button type="submit" class="flex w-full items-center gap-2 rounded-xl px-3 py-2 text-sm font-medium text-slate-700 transition-all duration-200 hover:bg-red-50 hover:text-red-600">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                                            Cerrar Sesión
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            
            <?php if(session('success')): ?>
                <div class="mx-4 sm:mx-6 mt-4">
                    <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-2xl flex items-center gap-2" role="alert">
                        <svg class="w-5 h-5 shrink-0 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        <?php echo e(session('success')); ?>

                    </div>
                </div>
            <?php endif; ?>

            <?php if(session('error')): ?>
                <div class="mx-4 sm:mx-6 mt-4">
                    <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-2xl flex items-center gap-2" role="alert">
                        <svg class="w-5 h-5 shrink-0 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        <?php echo e(session('error')); ?>

                    </div>
                </div>
            <?php endif; ?>

            <?php if($errors->any()): ?>
                <div class="mx-4 sm:mx-6 mt-4">
                    <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-2xl" role="alert">
                        <ul class="list-disc pl-5 text-sm">
                            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li><?php echo e($error); ?></li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                </div>
            <?php endif; ?>

            
            <main class="flex-1 p-4 sm:p-6 lg:p-8">
                <?php echo $__env->yieldContent('content'); ?>
            </main>

            
            <footer class="border-t border-sky-100 bg-white/80 backdrop-blur-sm px-4 sm:px-6 py-4">
                <div class="flex flex-col sm:flex-row items-center justify-between gap-2 text-xs text-gray-400">
                    <p>&copy; <?php echo e(date('Y')); ?> EduClub. Todos los derechos reservados.</p>
                    <p class="text-educlub/70 font-medium">Hecho con amor para la educación</p>
                </div>
            </footer>
        </div>
    </div>

</body>
</html>
<?php /**PATH C:\xampp\htdocs\xampp\Educlub\resources\views/layouts/app.blade.php ENDPATH**/ ?>