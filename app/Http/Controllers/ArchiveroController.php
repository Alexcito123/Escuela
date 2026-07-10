<?php

namespace App\Http\Controllers;

use App\Models\Archive;
use App\Models\Folder;
use App\Models\Grade;
use App\Http\Requests\StoreArchiveRequest;
use App\Http\Requests\UpdateArchiveRequest;
use App\Http\Requests\StoreFolderRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ArchiveroController extends Controller
{
    public function index()
    {
        $grades = Grade::orderBy('display_order')->get();
        return view('archivero.index', compact('grades'));
    }

    public function grade(Grade $grade)
    {
        $folders = $grade->folders()->withCount('archives')->orderBy('name')->get();
        return view('archivero.grade', compact('grade', 'folders'));
    }

    public function folder(Folder $folder)
    {
        $folder->load('grade');
        $archives = $folder->archives()->with('user')->orderBy('created_at', 'desc')->paginate(20);
        return view('archivero.folder', compact('folder', 'archives'));
    }

    public function create(Folder $folder)
    {
        $folder->load('grade');
        return view('archivero.create', compact('folder'));
    }

    public function store(StoreArchiveRequest $request)
    {
        $file = $request->file('file');
        $originalName = $file->getClientOriginalName();
        $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
        $filePath = $file->storeAs('archivos', $fileName, 'public');

        $folder = Folder::findOrFail($request->folder_id);

        Archive::create([
            'folder_id' => $request->folder_id,
            'grade_id' => $folder->grade_id,
            'title' => $request->title,
            'description' => $request->description,
            'file_path' => $filePath,
            'file_name' => $fileName,
            'original_name' => $originalName,
            'file_size' => $file->getSize(),
            'file_mime' => $file->getMimeType(),
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('archivero.folder', $folder)
            ->with('success', 'Archivo subido correctamente.');
    }

    public function edit(Archive $archive)
    {
        $archive->load('folder.grade');
        return view('archivero.edit', compact('archive'));
    }

    public function update(UpdateArchiveRequest $request, Archive $archive)
    {
        $archive->title = $request->title;
        $archive->description = $request->description;

        if ($request->hasFile('file')) {
            Storage::disk('public')->delete($archive->file_path);

            $file = $request->file('file');
            $originalName = $file->getClientOriginalName();
            $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $filePath = $file->storeAs('archivos', $fileName, 'public');

            $archive->file_path = $filePath;
            $archive->file_name = $fileName;
            $archive->original_name = $originalName;
            $archive->file_size = $file->getSize();
            $archive->file_mime = $file->getMimeType();
        }

        $archive->save();

        return redirect()->route('archivero.folder', $archive->folder)
            ->with('success', 'Archivo actualizado correctamente.');
    }

    public function destroy(Archive $archive)
    {
        $folder = $archive->folder;
        Storage::disk('public')->delete($archive->file_path);
        $archive->delete();

        return redirect()->route('archivero.folder', $folder)
            ->with('success', 'Archivo eliminado correctamente.');
    }

    public function download(Archive $archive)
    {
        if (!Storage::disk('public')->exists($archive->file_path)) {
            return back()->with('error', 'El archivo no existe en el servidor.');
        }

        return Storage::disk('public')->download($archive->file_path, $archive->original_name);
    }

    public function search(Request $request)
    {
        $query = Archive::query()->with('folder.grade', 'user');

        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('grade_id')) {
            $query->where('grade_id', $request->grade_id);
        }

        if ($request->filled('folder_id')) {
            $query->where('folder_id', $request->folder_id);
        }

        $archives = $query->orderBy('created_at', 'desc')->paginate(20);

        $grades = Grade::orderBy('display_order')->get();
        $folders = [];

        if ($request->filled('grade_id')) {
            $folders = Folder::where('grade_id', $request->grade_id)->orderBy('name')->get();
        }

        return view('archivero.search', compact('archives', 'grades', 'folders'));
    }

    public function storeFolder(StoreFolderRequest $request)
    {
        $exists = Folder::where('grade_id', $request->grade_id)
            ->where('name', $request->name)
            ->exists();

        if ($exists) {
            return back()->withErrors(['name' => 'Ya existe una carpeta con ese nombre en este grado.'])->withInput();
        }

        Folder::create([
            'grade_id' => $request->grade_id,
            'name' => $request->name,
            'description' => $request->description,
            'user_id' => auth()->id(),
        ]);

        return back()->with('success', 'Carpeta creada correctamente.');
    }

    public function destroyFolder(Folder $folder)
    {
        foreach ($folder->archives as $archive) {
            Storage::disk('public')->delete($archive->file_path);
            $archive->delete();
        }

        $gradeId = $folder->grade_id;
        $folder->delete();

        return redirect()->route('archivero.grade', $gradeId)
            ->with('success', 'Carpeta eliminada correctamente.');
    }

    public function getFolders(Request $request)
    {
        $folders = Folder::where('grade_id', $request->grade_id)
            ->orderBy('name')
            ->get(['id', 'name']);

        return response()->json($folders);
    }
}
