<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Teacher;
use App\Models\Course;
use App\Models\Payment;
use App\Models\Expense;
use App\Models\Archive;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $totalAlumnos = Student::count();
        $totalDocentes = Teacher::count();
        $totalCursos = Course::count();
        $totalArchivos = Archive::count();

        $hoy = now()->toDateString();
        $inicioMes = now()->startOfMonth()->toDateString();
        $finMes = now()->endOfMonth()->toDateString();

        $pagosDia = Payment::whereDate('fecha', $hoy)->where('estado', 'Pagado')->sum('monto');
        $pagosMes = Payment::whereBetween('fecha', [$inicioMes, $finMes])->where('estado', 'Pagado')->sum('monto');
        $gastosMes = Expense::whereBetween('fecha', [$inicioMes, $finMes])->sum('monto');

        $totalIngresos = Payment::where('estado', 'Pagado')->sum('monto');
        $totalEgresos = Expense::sum('monto');
        $balance = $totalIngresos - $totalEgresos;

        $alumnosAdeudo = Student::whereHas('payments', function ($q) {
            $q->where('estado', 'Pendiente');
        })->count();

        $ultimosAlumnos = Student::latest()->take(5)->get();

        $ultimosPagos = Payment::with('student')->latest()->take(3)->get();
        $ultimosGastos = Expense::latest()->take(3)->get();

        $ingresosMensuales = Payment::where('estado', 'Pagado')
            ->select(DB::raw("strftime('%m', fecha) as mes"), DB::raw('SUM(monto) as total'))
            ->whereYear('fecha', now()->year)
            ->groupBy('mes')
            ->orderBy('mes')
            ->pluck('total', 'mes');

        $gastosMensuales = Expense::select(DB::raw("strftime('%m', fecha) as mes"), DB::raw('SUM(monto) as total'))
            ->whereYear('fecha', now()->year)
            ->groupBy('mes')
            ->orderBy('mes')
            ->pluck('total', 'mes');

        $meses = ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'];
        $chartIngresos = [];
        $chartGastos = [];
        for ($i = 1; $i <= 12; $i++) {
            $m = str_pad($i, 2, '0', STR_PAD_LEFT);
            $chartIngresos[] = (float) ($ingresosMensuales[$m] ?? 0);
            $chartGastos[] = (float) ($gastosMensuales[$m] ?? 0);
        }

        return view('dashboard', compact(
            'totalAlumnos', 'totalDocentes', 'totalCursos', 'totalArchivos',
            'pagosDia', 'pagosMes', 'gastosMes',
            'totalIngresos', 'totalEgresos', 'balance',
            'alumnosAdeudo',
            'ultimosAlumnos', 'ultimosPagos', 'ultimosGastos',
            'meses', 'chartIngresos', 'chartGastos'
        ));
    }
}
