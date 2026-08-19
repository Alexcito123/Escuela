<?php

namespace App\Http\Controllers;

use App\Models\Archive;
use App\Models\Folder;
use App\Models\Grade;
use App\Http\Requests\StoreArchiveRequest;
use App\Http\Requests\UpdateArchiveRequest;
use App\Http\Requests\StoreFolderRequest;
use App\Http\Requests\UpdateFolderRequest;
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
        $files = $request->file('files');
        $folder = Folder::findOrFail($request->folder_id);

        $duplicate = Archive::where('folder_id', $request->folder_id)
            ->where('title', $request->title)
            ->where('user_id', auth()->id())
            ->where('created_at', '>=', now()->subSeconds(10))
            ->exists();

        if (!$duplicate) {
            $paths = [];
            $names = [];
            $originals = [];
            $sizes = [];
            $mimes = [];

            foreach ($files as $file) {
                $originalName = $file->getClientOriginalName();
                $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                $paths[] = $file->storeAs('archivos', $fileName, 'public');
                $names[] = $fileName;
                $originals[] = $originalName;
                $sizes[] = $file->getSize();
                $mimes[] = $file->getMimeType();
            }

            Archive::create([
                'folder_id' => $request->folder_id,
                'grade_id' => $folder->grade_id,
                'title' => $request->title,
                'description' => $request->description,
                'file_path' => $paths,
                'file_name' => $names,
                'original_name' => $originals,
                'file_size' => $sizes,
                'file_mime' => $mimes,
                'user_id' => auth()->id(),
            ]);
        }

        return redirect()->route('archivero.folder', $folder)
            ->with('success', 'Archivos subidos correctamente.');
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

        if ($request->hasFile('files')) {
            foreach ($archive->files as $existing) {
                Storage::disk('public')->delete($existing['path']);
            }

            $paths = [];
            $names = [];
            $originals = [];
            $sizes = [];
            $mimes = [];

            foreach ($request->file('files') as $file) {
                $originalName = $file->getClientOriginalName();
                $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                $paths[] = $file->storeAs('archivos', $fileName, 'public');
                $names[] = $fileName;
                $originals[] = $originalName;
                $sizes[] = $file->getSize();
                $mimes[] = $file->getMimeType();
            }

            $archive->file_path = $paths;
            $archive->file_name = $names;
            $archive->original_name = $originals;
            $archive->file_size = $sizes;
            $archive->file_mime = $mimes;
        }

        $archive->save();

        return redirect()->route('archivero.folder', $archive->folder)
            ->with('success', 'Archivo actualizado correctamente.');
    }

    public function destroy(Archive $archive)
    {
        $folder = $archive->folder;

        foreach ($archive->files as $existing) {
            Storage::disk('public')->delete($existing['path']);
        }

        $archive->delete();

        return redirect()->route('archivero.folder', $folder)
            ->with('success', 'Archivo eliminado correctamente.');
    }

    public function download(Archive $archive)
    {
        $files = $archive->files;

        if (empty($files)) {
            return back()->with('error', 'El archivo no existe en el servidor.');
        }

        $existing = array_filter($files, fn ($f) => Storage::disk('public')->exists($f['path']));

        if (empty($existing)) {
            return back()->with('error', 'El archivo no existe en el servidor.');
        }

        if (count($existing) === 1) {
            $file = reset($existing);

            return Storage::disk('public')->download($file['path'], $file['original_name']);
        }

        $zipPath = tempnam(sys_get_temp_dir(), 'educlub_') . '.zip';
        $zip = new \ZipArchive();
        $zip->open($zipPath, \ZipArchive::CREATE | \ZipArchive::OVERWRITE);

        $usedNames = [];
        foreach ($existing as $file) {
            $name = $file['original_name'];
            if (isset($usedNames[$name])) {
                $parts = pathinfo($file['original_name']);
                $name = $parts['filename'] . '_' . $usedNames[$name] . '.' . ($parts['extension'] ?? '');
            }
            $usedNames[$name] = ($usedNames[$name] ?? 0) + 1;
            $zip->addFile(Storage::disk('public')->path($file['path']), $name);
        }

        $zip->close();

        return response()
            ->download($zipPath, 'archivos_' . $archive->id . '.zip')
            ->deleteFileAfterSend(true);
    }

    public function print(Archive $archive)
    {
        $archive->load('folder.grade');
        $files = array_filter($archive->files, fn ($f) => Storage::disk('public')->exists($f['path']));

        return view('archivero.print', compact('archive', 'files'));
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

    public function updateFolder(UpdateFolderRequest $request, Folder $folder)
    {
        $exists = Folder::where('grade_id', $folder->grade_id)
            ->where('name', $request->name)
            ->where('id', '!=', $folder->id)
            ->exists();

        if ($exists) {
            return back()->withErrors(['name' => 'Ya existe una carpeta con ese nombre en este grado.'])->withInput();
        }

        $folder->update([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        return redirect()->route('archivero.grade', $folder->grade_id)
            ->with('success', 'Carpeta actualizada correctamente.');
    }

    public function destroyFolder(Folder $folder)
    {
        foreach ($folder->archives as $archive) {
            foreach ($archive->files as $existing) {
                Storage::disk('public')->delete($existing['path']);
            }
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
