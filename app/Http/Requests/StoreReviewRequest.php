<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreReviewRequest extends FormRequest
{
    /**
     * Determina si el usuario está autorizado para hacer esta petición.
     */
    public function authorize(): bool
    {
        return true; // Permitimos que cualquier usuario logueado envíe una reseña
    }

    /**
     * Obtiene las reglas de validación que se aplican a la petición.
     */
    public function rules(): array
    {
        return [
            // El rating es obligatorio, numérico y debe estar entre 1 y 5 [cite: 147-148]
            'rating' => 'required|integer|min:1|max:5',
            // El comentario es obligatorio y debe ser texto
            'comment' => 'required|string|max:1000',
        ];
    }
}