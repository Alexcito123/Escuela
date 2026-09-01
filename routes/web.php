<?php

use App\Http\Controllers\ArchiveroController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GastosController;
use App\Http\Controllers\ImageConverterController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware('auth')->get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'create'])->name('login');
    Route::post('/login', [LoginController::class, 'store']);
    Route::get('/register', [RegisterController::class, 'create'])->name('register');
    Route::post('/register', [RegisterController::class, 'store']);
});

Route::post('/logout', [LoginController::class, 'destroy'])->name('logout');

Route::middleware('auth')->prefix('perfil')->name('perfil.')->group(function () {
    Route::get('/', [ProfileController::class, 'show'])->name('show');
    Route::get('/editar', [ProfileController::class, 'edit'])->name('edit');
    Route::put('/', [ProfileController::class, 'update'])->name('update');
    Route::delete('/avatar', [ProfileController::class, 'destroyAvatar'])->name('destroyAvatar');
});

Route::middleware('auth')->prefix('formato-imagen')->name('imagenes.')->group(function () {
    Route::get('/', [ImageConverterController::class, 'index'])->name('index');
    Route::post('/convertir', [ImageConverterController::class, 'convert'])->name('convert');
});

Route::middleware('auth')->prefix('archivero')->name('archivero.')->group(function () {
    Route::get('/', [ArchiveroController::class, 'index'])->name('index');
    Route::get('/buscar', [ArchiveroController::class, 'search'])->name('search');
    Route::get('/folders-por-grado', [ArchiveroController::class, 'getFolders'])->name('foldersByGrade');
    Route::get('/grado/{grade}', [ArchiveroController::class, 'grade'])->name('grade');
    Route::get('/carpeta/{folder}', [ArchiveroController::class, 'folder'])->name('folder');
    Route::get('/subir/{folder}', [ArchiveroController::class, 'create'])->name('create');
    Route::post('/', [ArchiveroController::class, 'store'])->name('store');
    Route::get('/{archive}/editar', [ArchiveroController::class, 'edit'])->name('edit');
    Route::put('/{archive}', [ArchiveroController::class, 'update'])->name('update');
    Route::delete('/{archive}', [ArchiveroController::class, 'destroy'])->name('destroy');
    Route::delete('/{archive}/archivo/{index}', [ArchiveroController::class, 'destroyFile'])->name('destroyFile');
    Route::get('/descargar/{archive}', [ArchiveroController::class, 'download'])->name('download');
    Route::get('/imprimir/{archive}', [ArchiveroController::class, 'print'])->name('print');
    Route::post('/carpeta', [ArchiveroController::class, 'storeFolder'])->name('storeFolder');
    Route::put('/carpeta/{folder}', [ArchiveroController::class, 'updateFolder'])->name('updateFolder');
    Route::delete('/carpeta/{folder}', [ArchiveroController::class, 'destroyFolder'])->name('destroyFolder');
});

Route::middleware('auth')->prefix('gastos')->name('gastos.')->group(function () {
    Route::get('/', [GastosController::class, 'index'])->name('index');
    Route::post('/', [GastosController::class, 'storeMonth'])->name('storeMonth');
    Route::get('/{month}', [GastosController::class, 'month'])->name('month');
    Route::put('/{month}', [GastosController::class, 'updateMonth'])->name('updateMonth');
    Route::delete('/{month}', [GastosController::class, 'destroyMonth'])->name('destroyMonth');
    Route::post('/semana', [GastosController::class, 'storeWeek'])->name('storeWeek');
    Route::get('/semana/{week}', [GastosController::class, 'week'])->name('week');
    Route::put('/semana/{week}', [GastosController::class, 'updateWeek'])->name('updateWeek');
    Route::delete('/semana/{week}', [GastosController::class, 'destroyWeek'])->name('destroyWeek');
    Route::post('/semana/{week}/rows', [GastosController::class, 'saveRows'])->name('saveRows');
});
