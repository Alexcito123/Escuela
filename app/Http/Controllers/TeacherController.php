<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use App\Http\Requests\StoreTeacherRequest;
use App\Http\Requests\UpdateTeacherRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TeacherController extends Controller
{
    public function index(Request $request)
    {
        $query = Teacher::query();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nombre', 'like', "%{$search}%")
                  ->orWhere('apellido_paterno', 'like', "%{$search}%")
                  ->orWhere('apellido_materno', 'like', "%{$search}%")
                  ->orWhere('curp', 'like', "%{$search}%")
                  ->orWhere('especialidad', 'like', "%{$search}%");
            });
        }

        if ($request->filled('estado')) {
            $query->where('estado', $request->estado);
        }

        $teachers = $query->orderBy('apellido_paterno')->orderBy('apellido_materno')->orderBy('nombre')->paginate(20);

        return view('teachers.index', compact('teachers'));
    }

    public function create()
    {
        return view('teachers.create');
    }

    public function store(StoreTeacherRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('fotografia')) {
            $data['fotografia'] = $request->file('fotografia')->store('fotos/docentes', 'public');
        }

        Teacher::create($data);

        return redirect()->route('teachers.index')
            ->with('success', 'Docente registrado correctamente.');
    }

    public function show(Teacher $teacher)
    {
        return view('teachers.show', compact('teacher'));
    }

    public function edit(Teacher $teacher)
    {
        return view('teachers.edit', compact('teacher'));
    }

    public function update(UpdateTeacherRequest $request, Teacher $teacher)
    {
        $data = $request->validated();

        if ($request->hasFile('fotografia')) {
            if ($teacher->fotografia) {
                Storage::disk('public')->delete($teacher->fotografia);
            }
            $data['fotografia'] = $request->file('fotografia')->store('fotos/docentes', 'public');
        }

        $teacher->update($data);

        return redirect()->route('teachers.index')
            ->with('success', 'Docente actualizado correctamente.');
    }

    public function destroy(Teacher $teacher)
    {
        if ($teacher->fotografia) {
            Storage::disk('public')->delete($teacher->fotografia);
        }

        $teacher->delete();

        return redirect()->route('teachers.index')
            ->with('success', 'Docente eliminado correctamente.');
    }
}
