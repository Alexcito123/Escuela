<?php

namespace App\Http\Controllers;

use App\Models\Archive;
use App\Models\Grade;

class DashboardController extends Controller
{
    public function index()
    {
        $totalArchivos = Archive::count();
        $totalCarpetas = Grade::withCount('folders')->get()->sum('folders_count');
        $totalGrados = Grade::count();

        return view('dashboard', compact('totalArchivos', 'totalCarpetas', 'totalGrados'));
    }
}