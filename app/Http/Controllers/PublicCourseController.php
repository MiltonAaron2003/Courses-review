<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class PublicCourseController extends Controller
{
    /**
     * Muestra la lista de cursos en la página de inicio.
     */
    public function index()
    {
        // Obtenemos los cursos ordenados por el más reciente, paginados de 10 en 10
        // Esto cumple con el requisito del PDF de paginación [cite: 119]
        $courses = Course::latest()->paginate(10);

        // Renderizamos la vista 'home' y le pasamos los datos
        return view('home', ['courses' => $courses]);
    }

    /**
     * Muestra el detalle de un curso específico.
     * (Este método lo usaremos en el siguiente paso, pero lo dejamos preparado)
     */
    public function show(Course $course)
    {
        // Aquí cargaremos las relaciones más adelante
        return view('courses.show', ['course' => $course]);
    }
}