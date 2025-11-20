<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\PublicCourseController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// --- RUTAS PÚBLICAS ---
Route::get('/', [PublicCourseController::class, 'index'])->name('home');
// Nueva ruta para el detalle del curso
Route::get('/curso/{course}', [PublicCourseController::class, 'show'])->name('courses.show');

// --- RUTAS PROTEGIDAS ---
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Rutas para administrar cursos (CRUD)
    Route::resource('courses', CourseController::class)->except(['index', 'show']);
});

require __DIR__.'/auth.php';