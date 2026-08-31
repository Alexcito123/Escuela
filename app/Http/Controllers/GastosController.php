<?php

namespace App\Http\Controllers;

use App\Models\GastoMonth;
use App\Models\GastoWeek;
use App\Models\GastoRow;
use Illuminate\Http\Request;

class GastosController extends Controller
{
    public function index()
    {
        $months = GastoMonth::withCount('weeks')
            ->orderByDesc('year')
            ->orderByDesc('month_number')
            ->get();

        return view('gastos.index', compact('months'));
    }

    public function month(GastoMonth $month)
    {
        $weeks = $month->weeks()->withCount('rows')->orderBy('week_number')->get();
        return view('gastos.month', compact('month', 'weeks'));
    }

    public function week(GastoWeek $week)
    {
        $week->load('gastoMonth');
        $rows = $week->rows()->orderBy('row_order')->get();
        return view('gastos.week', compact('week', 'rows'));
    }

    public function storeMonth(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'month_number' => 'required|integer|between:1,12',
            'year' => 'required|integer|min:2020|max:2100',
        ]);

        $exists = GastoMonth::where('month_number', $request->month_number)
            ->where('year', $request->year)
            ->exists();

        if ($exists) {
            return back()->withErrors(['year' => 'Ya existe un mes para esa fecha.'])->withInput();
        }

        GastoMonth::create([
            'name' => $request->name,
            'month_number' => $request->month_number,
            'year' => $request->year,
            'user_id' => auth()->id(),
        ]);

        return back()->with('success', 'Mes creado correctamente.');
    }

    public function updateMonth(Request $request, GastoMonth $month)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $month->update(['name' => $request->name]);

        return redirect()->route('gastos.month', $month)
            ->with('success', 'Mes actualizado correctamente.');
    }

    public function destroyMonth(GastoMonth $month)
    {
        foreach ($month->weeks as $week) {
            $week->rows()->delete();
        }
        $month->weeks()->delete();
        $month->delete();

        return redirect()->route('gastos.index')
            ->with('success', 'Mes eliminado correctamente.');
    }

    public function storeWeek(Request $request)
    {
        $request->validate([
            'gasto_month_id' => 'required|exists:gasto_months,id',
            'name' => 'required|string|max:255',
            'date_range' => 'nullable|string|max:255',
        ]);

        $month = GastoMonth::findOrFail($request->gasto_month_id);
        $weekNumber = $month->weeks()->count() + 1;

        GastoWeek::create([
            'gasto_month_id' => $request->gasto_month_id,
            'name' => $request->name,
            'date_range' => $request->date_range,
            'week_number' => $weekNumber,
            'user_id' => auth()->id(),
        ]);

        return back()->with('success', 'Semana creada correctamente.');
    }

    public function updateWeek(Request $request, GastoWeek $week)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $week->update(['name' => $request->name]);

        return redirect()->route('gastos.week', $week)
            ->with('success', 'Semana actualizada correctamente.');
    }

    public function destroyWeek(GastoWeek $week)
    {
        $monthId = $week->gasto_month_id;
        $week->rows()->delete();
        $week->delete();

        return redirect()->route('gastos.month', $monthId)
            ->with('success', 'Semana eliminada correctamente.');
    }

    public function saveRows(Request $request, GastoWeek $week)
    {
        $rows = $request->input('rows', []);

        $existingIds = collect($rows)->pluck('id')->filter()->values()->toArray();
        $week->rows()->whereNotIn('id', $existingIds)->delete();

        foreach ($rows as $index => $row) {
            $alumno = trim($row['alumno'] ?? '');

            if ($alumno === '') {
                continue;
            }

            $data = [
                'alumno' => $alumno,
                'pago_semanal' => $row['pago_semanal'] ?? '',
                'mensual' => $row['mensual'] ?? '',
                'columna1' => $row['columna1'] ?? '',
                'gastos_semana' => $row['gastos_semana'] ?? '',
                'row_order' => $index,
            ];

            if (!empty($row['id'])) {
                GastoRow::where('id', $row['id'])
                    ->where('gasto_week_id', $week->id)
                    ->update($data);
            } else {
                GastoRow::create(array_merge($data, [
                    'gasto_week_id' => $week->id,
                    'user_id' => auth()->id(),
                ]));
            }
        }

        return back()->with('success', 'Datos guardados correctamente.');
    }
}
