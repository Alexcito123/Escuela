<?php

use App\Http\Controllers\ArchiveroController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'create'])->name('login');
    Route::post('/login', [LoginController::class, 'store']);
    Route::get('/register', [RegisterController::class, 'create'])->name('register');
    Route::post('/register', [RegisterController::class, 'store']);
});

Route::post('/logout', [LoginController::class, 'destroy'])->name('logout');

Route::middleware('auth')->prefix('alumnos')->name('students.')->group(function () {
    Route::get('/', [StudentController::class, 'index'])->name('index');
    Route::get('/crear', [StudentController::class, 'create'])->name('create');
    Route::post('/', [StudentController::class, 'store'])->name('store');
    Route::get('/{student}', [StudentController::class, 'show'])->name('show');
    Route::get('/{student}/editar', [StudentController::class, 'edit'])->name('edit');
    Route::put('/{student}', [StudentController::class, 'update'])->name('update');
    Route::delete('/{student}', [StudentController::class, 'destroy'])->name('destroy');
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
    Route::get('/descargar/{archive}', [ArchiveroController::class, 'download'])->name('download');
    Route::post('/carpeta', [ArchiveroController::class, 'storeFolder'])->name('storeFolder');
    Route::delete('/carpeta/{folder}', [ArchiveroController::class, 'destroyFolder'])->name('destroyFolder');
});
