<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CourseController; // <-- Asegúrate de que esto esté importado
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Rutas para administrar cursos (CRUD)
    // Ya no excluimos 'index', solo 'show'
    Route::resource('courses', CourseController::class)->except(['show']);
});

require __DIR__.'/auth.php';