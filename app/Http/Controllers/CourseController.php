<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Requests\StoreCourseRequest;
use App\Http\Requests\UpdateCourseRequest;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::latest()->get(); 
        return view('courses.index', ['courses' => $courses]);
    }

    public function create()
    {
        return view('courses.create');
    }

    public function store(StoreCourseRequest $request)
    {
        Course::create([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'description' => $request->description,
            'instructor' => $request->instructor,
        ]);
        return redirect()->route('courses.index')->with('success', 'Curso creado exitosamente.');
    }

    public function edit(Course $course)
    {
        return view('courses.edit', ['course' => $course]);
    }

    public function update(UpdateCourseRequest $request, Course $course)
    {
        $course->update([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'description' => $request->description,
            'instructor' => $request->instructor,
        ]);

        return redirect()->route('courses.index')->with('success', 'Curso actualizado exitosamente.');
    }

    /**
     * Elimina el curso de la base de datos.
     */
    public function destroy(Course $course)
    {
        // Laravel encuentra el curso automáticamente
        $course->delete();

        return redirect()->route('courses.index')->with('success', 'Curso eliminado exitosamente.');
    }
}