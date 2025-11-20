<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class PublicCourseController extends Controller
{
    public function index()
    {
        // Paginación de 10 cursos para la portada
        $courses = Course::latest()->paginate(10);
        return view('home', ['courses' => $courses]);
    }

    public function show(Course $course)
    {
        // REQUISITO CRÍTICO DEL PDF: Eager Loading
        // Cargamos las reseñas Y los autores de esas reseñas para evitar el problema N+1
        $course->load('reviews.user');

        return view('courses.show', ['course' => $course]);
    }
}