<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\PublicCourseController;
use App\Http\Controllers\ReviewController; // <-- Importamos el nuevo controlador
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// --- RUTAS PÚBLICAS ---
Route::get('/', [PublicCourseController::class, 'index'])->name('home');
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

    // Ruta para guardar reseñas [cite: 144-145]
    Route::post('/curso/{course}/reviews', [ReviewController::class, 'store'])->name('reviews.store');
});

require __DIR__.'/auth.php';