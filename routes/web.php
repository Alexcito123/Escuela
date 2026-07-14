<?php

use App\Http\Controllers\ArchiveroController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return auth()->check()
        ? redirect()->route('archivero.index')
        : redirect()->route('login');
});

Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'create'])->name('login');
    Route::post('/login', [LoginController::class, 'store']);
    Route::get('/register', [RegisterController::class, 'create'])->name('register');
    Route::post('/register', [RegisterController::class, 'store']);
});

Route::post('/logout', [LoginController::class, 'destroy'])->name('logout');

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
    Route::get('/descargar/{archive}', [ArchiveroController::class, 'download'])->name('download');
    Route::post('/carpeta', [ArchiveroController::class, 'storeFolder'])->name('storeFolder');
    Route::delete('/carpeta/{folder}', [ArchiveroController::class, 'destroyFolder'])->name('destroyFolder');
});
