<?php

use App\Http\Controllers\ArchiveroController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ImageConverterController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ExpenseController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'create'])->name('login');
    Route::post('/login', [LoginController::class, 'store']);
    Route::get('/register', [RegisterController::class, 'create'])->name('register');
    Route::post('/register', [RegisterController::class, 'store']);
});

Route::post('/logout', [LoginController::class, 'destroy'])->name('logout');

Route::middleware('auth')->prefix('formato-imagen')->name('imagenes.')->group(function () {
    Route::get('/', [ImageConverterController::class, 'index'])->name('index');
    Route::post('/convertir', [ImageConverterController::class, 'convert'])->name('convert');
});

Route::middleware('auth')->prefix('alumnos')->name('students.')->group(function () {
    Route::get('/', [StudentController::class, 'index'])->name('index');
    Route::get('/crear', [StudentController::class, 'create'])->name('create');
    Route::post('/', [StudentController::class, 'store'])->name('store');
    Route::get('/{student}', [StudentController::class, 'show'])->name('show');
    Route::get('/{student}/editar', [StudentController::class, 'edit'])->name('edit');
    Route::put('/{student}', [StudentController::class, 'update'])->name('update');
    Route::delete('/{student}', [StudentController::class, 'destroy'])->name('destroy');
    Route::get('/grado/{grade}', [StudentController::class, 'byGrade'])->name('byGrade');
});

Route::middleware('auth')->prefix('docentes')->name('teachers.')->group(function () {
    Route::get('/', [TeacherController::class, 'index'])->name('index');
    Route::get('/crear', [TeacherController::class, 'create'])->name('create');
    Route::post('/', [TeacherController::class, 'store'])->name('store');
    Route::get('/{teacher}', [TeacherController::class, 'show'])->name('show');
    Route::get('/{teacher}/editar', [TeacherController::class, 'edit'])->name('edit');
    Route::put('/{teacher}', [TeacherController::class, 'update'])->name('update');
    Route::delete('/{teacher}', [TeacherController::class, 'destroy'])->name('destroy');
});

Route::middleware('auth')->prefix('cursos')->name('courses.')->group(function () {
    Route::get('/', [CourseController::class, 'index'])->name('index');
    Route::get('/crear', [CourseController::class, 'create'])->name('create');
    Route::post('/', [CourseController::class, 'store'])->name('store');
    Route::get('/{course}', [CourseController::class, 'show'])->name('show');
    Route::get('/{course}/editar', [CourseController::class, 'edit'])->name('edit');
    Route::put('/{course}', [CourseController::class, 'update'])->name('update');
    Route::delete('/{course}', [CourseController::class, 'destroy'])->name('destroy');
});

Route::middleware('auth')->prefix('gastos')->name('expenses.')->group(function () {
    Route::get('/', [ExpenseController::class, 'index'])->name('index');
    Route::get('/crear', [ExpenseController::class, 'create'])->name('create');
    Route::post('/', [ExpenseController::class, 'store'])->name('store');
    Route::get('/{expense}', [ExpenseController::class, 'show'])->name('show');
    Route::get('/{expense}/editar', [ExpenseController::class, 'edit'])->name('edit');
    Route::put('/{expense}', [ExpenseController::class, 'update'])->name('update');
    Route::delete('/{expense}', [ExpenseController::class, 'destroy'])->name('destroy');
});

Route::middleware('auth')->prefix('pagos')->name('payments.')->group(function () {
    Route::get('/', [PaymentController::class, 'index'])->name('index');
    Route::get('/crear', [PaymentController::class, 'create'])->name('create');
    Route::post('/', [PaymentController::class, 'store'])->name('store');
    Route::get('/alumno/{student}', [PaymentController::class, 'studentHistory'])->name('student');
    Route::get('/{payment}', [PaymentController::class, 'show'])->name('show');
    Route::get('/{payment}/editar', [PaymentController::class, 'edit'])->name('edit');
    Route::put('/{payment}', [PaymentController::class, 'update'])->name('update');
    Route::delete('/{payment}', [PaymentController::class, 'destroy'])->name('destroy');
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
