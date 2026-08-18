<?php

namespace App\Http\Controllers;

use App\Models\Grade;
use App\Models\Student;
use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StudentController extends Controller
{
    public function index(Request $request)
    {
        $query = Student::query()->with('grade');

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nombre', 'like', "%{$search}%")
                  ->orWhere('apellido_paterno', 'like', "%{$search}%")
                  ->orWhere('apellido_materno', 'like', "%{$search}%")
                  ->orWhere('curp', 'like', "%{$search}%");
            });
        }

        if ($request->filled('grade_id')) {
            $query->where('grade_id', $request->grade_id);
        }

        if ($request->filled('estado')) {
            $query->where('estado', $request->estado);
        }

        $students = $query->orderBy('apellido_paterno')->orderBy('apellido_materno')->orderBy('nombre')->paginate(20);
        $grades = Grade::orderBy('display_order')->get();

        return view('students.index', compact('students', 'grades'));
    }

    public function create()
    {
        $grades = Grade::orderBy('display_order')->get();
        return view('students.create', compact('grades'));
    }

    public function store(StoreStudentRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('fotografia')) {
            $data['fotografia'] = $request->file('fotografia')->store('fotos', 'public');
        }

        Student::create($data);

        return redirect()->route('students.index')
            ->with('success', 'Alumno registrado correctamente.');
    }

    public function show(Student $student)
    {
        $student->load('grade');
        return view('students.show', compact('student'));
    }

    public function edit(Student $student)
    {
        $grades = Grade::orderBy('display_order')->get();
        return view('students.edit', compact('student', 'grades'));
    }

    public function update(UpdateStudentRequest $request, Student $student)
    {
        $data = $request->validated();

        if ($request->hasFile('fotografia')) {
            if ($student->fotografia) {
                Storage::disk('public')->delete($student->fotografia);
            }
            $data['fotografia'] = $request->file('fotografia')->store('fotos', 'public');
        }

        $student->update($data);

        return redirect()->route('students.index')
            ->with('success', 'Alumno actualizado correctamente.');
    }

    public function destroy(Student $student)
    {
        if ($student->fotografia) {
            Storage::disk('public')->delete($student->fotografia);
        }

        $student->delete();

        return redirect()->route('students.index')
            ->with('success', 'Alumno eliminado correctamente.');
    }

    public function byGrade(Grade $grade)
    {
        $students = $grade->students()->orderBy('apellido_paterno')->orderBy('apellido_materno')->orderBy('nombre')->paginate(50);
        $grades = Grade::orderBy('display_order')->get();

        return view('students.index', compact('students', 'grades'))
            ->with('selectedGrade', $grade->id);
    }
}
