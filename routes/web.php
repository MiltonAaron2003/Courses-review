<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\PublicCourseController; // <-- Importamos el nuevo controlador
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// --- RUTAS PÚBLICAS (Accesibles para todos) ---
// Página de inicio (Listado de cursos) [cite: 111]
Route::get('/', [PublicCourseController::class, 'index'])->name('home');

// --- RUTAS PROTEGIDAS (Requieren inicio de sesión) ---
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Rutas para administrar cursos (CRUD)
    // Solo usuarios autenticados pueden crear, editar, borrar
    Route::resource('courses', CourseController::class)->except(['index', 'show']);
});

require __DIR__.'/auth.php';