<?php $__env->startSection('title', 'Mi Perfil'); ?>
<?php $__env->startSection('page-title', 'Mi Perfil'); ?>

<?php $__env->startSection('content'); ?>
<div class="max-w-2xl mx-auto">
    <div class="bg-white rounded-3xl shadow-xl shadow-gray-200/50 border border-gray-100 overflow-hidden">

        
        <div class="bg-educlub p-6 relative" style="background-image: linear-gradient(to right, #4FC3E8, #2FA5CE, #7ED3A0);">
            <div class="flex items-center gap-4">
                <div class="w-16 h-16 rounded-full bg-white/20 flex items-center justify-center overflow-hidden">
                    <?php if(auth()->user()->avatar_url): ?>
                        <img src="<?php echo e(auth()->user()->avatar_url); ?>" alt="Foto de perfil" class="w-full h-full object-cover">
                    <?php else: ?>
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                    <?php endif; ?>
                </div>
                <div>
                    <h2 class="text-xl font-bold text-white"><?php echo e(auth()->user()->name); ?></h2>
                    <p class="text-sm text-white/80"><?php echo e(auth()->user()->email); ?></p>
                </div>
            </div>
        </div>

        
        <form method="POST" action="<?php echo e(route('perfil.update')); ?>" enctype="multipart/form-data" class="p-6 sm:p-8">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>

            <div class="space-y-5">
                
                <div class="flex items-center gap-4 py-2">
                    <div class="w-20 h-20 rounded-full bg-educlub/10 flex items-center justify-center overflow-hidden shrink-0">
                        <?php if(auth()->user()->avatar_url): ?>
                            <img src="<?php echo e(auth()->user()->avatar_url); ?>" alt="Foto de perfil" class="w-full h-full object-cover">
                        <?php else: ?>
                            <svg class="w-9 h-9 text-educlub" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                        <?php endif; ?>
                    </div>
                    <div class="flex-1">
                        <label for="avatar" class="block text-sm font-semibold text-gray-700 mb-3">Foto de Perfil</label>
                        <div class="mb-3">
                            <input type="file" name="avatar" id="avatar" accept="image/*" class="hidden">
                            <label for="avatar" class="inline-flex items-center justify-center gap-2 px-6 py-3 rounded-xl cursor-pointer bg-cyan-500 hover:bg-cyan-600 text-black font-semibold text-base shadow-sm border border-slate-300 transition-all duration-200">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M19 13h-6v6h-2v-6H5v-2h6V5h2v6h6v2z"/>
                                </svg>
                                <span>Subir archivo</span>
                            </label>
                        </div>
                        <p class="text-xs text-gray-400">JPG, PNG, GIF o WEBP. Máximo 2MB.</p>
                        <?php $__errorArgs = ['avatar'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <p class="mt-1.5 text-xs text-red-500"><?php echo e($message); ?></p>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                </div>

                <div>
                    <label for="name" class="block text-sm font-semibold text-gray-700 mb-1.5">Nombre</label>
                    <input type="text" name="name" id="name" value="<?php echo e(old('name', auth()->user()->name)); ?>"
                        class="input-field <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-300 focus:ring-red-300 focus:border-red-300 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                        required>
                    <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="mt-1.5 text-xs text-red-500"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div>
                    <label for="email" class="block text-sm font-semibold text-gray-700 mb-1.5">Correo Electrónico</label>
                    <input type="email" name="email" id="email" value="<?php echo e(old('email', auth()->user()->email)); ?>"
                        class="input-field <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-300 focus:ring-red-300 focus:border-red-300 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                        required>
                    <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="mt-1.5 text-xs text-red-500"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div class="border-t border-gray-100 pt-5">
                    <p class="text-sm font-semibold text-gray-700 mb-1.5">Cambiar Contraseña</p>
                    <p class="text-xs text-gray-500 mb-4">Déjalo en blanco si no deseas cambiarla.</p>

                    <div class="space-y-4">
                        <div>
                            <label for="password" class="block text-sm font-semibold text-gray-700 mb-1.5">Nueva Contraseña</label>
                            <input type="password" name="password" id="password" autocomplete="new-password"
                                class="input-field <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-300 focus:ring-red-300 focus:border-red-300 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                            <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <p class="mt-1.5 text-xs text-red-500"><?php echo e($message); ?></p>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <div>
                            <label for="password_confirmation" class="block text-sm font-semibold text-gray-700 mb-1.5">Confirmar Contraseña</label>
                            <input type="password" name="password_confirmation" id="password_confirmation" autocomplete="new-password"
                                class="input-field">
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-8 flex items-center justify-end gap-3">
                <a href="<?php echo e(route('dashboard')); ?>" class="btn-secondary">
                    Cancelar
                </a>
                <button type="submit" class="btn-primary">
                    Guardar Cambios
                </button>
            </div>
        </form>

        <?php if(auth()->user()->avatar_url): ?>
            <div class="flex items-center justify-between bg-red-50 border-t border-red-100 px-4 py-3">
                <span class="text-sm text-gray-600">¿Eliminar tu foto de perfil actual?</span>
                <form method="POST" action="<?php echo e(route('perfil.destroyAvatar')); ?>"
                      onsubmit="return confirm('¿Eliminar tu foto de perfil?')" class="inline">
                    <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                    <button type="submit" class="text-sm font-semibold text-red-500 hover:text-red-700">Eliminar foto</button>
                </form>
            </div>
        <?php endif; ?>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\xampp\Educlub\resources\views/profile/edit.blade.php ENDPATH**/ ?>