<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreReviewRequest;
use App\Models\Course;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    /**
     * Guarda una nueva reseña para un curso específico.
     */
    public function store(StoreReviewRequest $request, Course $course)
    {
        // Creamos la reseña usando la relación 'reviews' del curso
        $course->reviews()->create([
            'user_id' => auth()->id(), // Asignamos el ID del usuario autenticado [cite: 150]
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);

        // Redirigimos de vuelta a la página del curso con un mensaje de éxito [cite: 152]
        return back()->with('success', '¡Gracias por tu reseña!');
    }
}