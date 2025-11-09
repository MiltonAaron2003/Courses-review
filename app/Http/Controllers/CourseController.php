<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Support\Str; // <-- 1. IMPORTANTE: Para generar el slug
use App\Http\Requests\StoreCourseRequest; // <-- 2. Importa el Form Request

class CourseController extends Controller
{
    /**
     * Muestra el formulario para crear un nuevo curso.
     */
    public function create()
    {
        return view('courses.create'); // 3. Le decimos que muestre la vista
    }

    /**
     * Guarda el nuevo curso en la base de datos.
     */
    public function store(StoreCourseRequest $request)
    {
        // 4. Laravel ya validó los datos gracias a StoreCourseRequest

        // 5. Creamos el curso
        Course::create([
            'title' => $request->title,
            'slug' => Str::slug($request->title), // 6. Genera un slug amigable (ej: "hola-mundo")
            'description' => $request->description,
            'instructor' => $request->instructor,
        ]);

        // 7. Redirigimos (usaremos 'dashboard' por ahora)
        return redirect()->route('dashboard')->with('success', 'Curso creado exitosamente.');
    }

    // ... (Los otros métodos como edit, update, destroy están vacíos por ahora)
}