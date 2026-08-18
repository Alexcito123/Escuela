<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Grade;
use App\Models\Teacher;
use App\Http\Requests\StoreCourseRequest;
use App\Http\Requests\UpdateCourseRequest;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index(Request $request)
    {
        $query = Course::query()->with('grade', 'teacher');

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where('nombre', 'like', "%{$search}%");
        }

        if ($request->filled('grade_id')) {
            $query->where('grade_id', $request->grade_id);
        }

        if ($request->filled('teacher_id')) {
            $query->where('teacher_id', $request->teacher_id);
        }

        if ($request->filled('estado')) {
            $query->where('estado', $request->estado);
        }

        $courses = $query->orderBy('nombre')->paginate(20);
        $grades = Grade::orderBy('display_order')->get();
        $teachers = Teacher::where('estado', 'Activo')->orderBy('apellido_paterno')->get();

        return view('courses.index', compact('courses', 'grades', 'teachers'));
    }

    public function create()
    {
        $grades = Grade::orderBy('display_order')->get();
        $teachers = Teacher::where('estado', 'Activo')->orderBy('apellido_paterno')->get();
        return view('courses.create', compact('grades', 'teachers'));
    }

    public function store(StoreCourseRequest $request)
    {
        Course::create($request->validated());

        return redirect()->route('courses.index')
            ->with('success', 'Curso creado correctamente.');
    }

    public function show(Course $course)
    {
        $course->load('grade', 'teacher');
        return view('courses.show', compact('course'));
    }

    public function edit(Course $course)
    {
        $grades = Grade::orderBy('display_order')->get();
        $teachers = Teacher::where('estado', 'Activo')->orderBy('apellido_paterno')->get();
        return view('courses.edit', compact('course', 'grades', 'teachers'));
    }

    public function update(UpdateCourseRequest $request, Course $course)
    {
        $course->update($request->validated());

        return redirect()->route('courses.index')
            ->with('success', 'Curso actualizado correctamente.');
    }

    public function destroy(Course $course)
    {
        $course->delete();

        return redirect()->route('courses.index')
            ->with('success', 'Curso eliminado correctamente.');
    }
}
