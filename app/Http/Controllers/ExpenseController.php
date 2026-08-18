<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\Http\Requests\StoreExpenseRequest;
use App\Http\Requests\UpdateExpenseRequest;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    public function index(Request $request)
    {
        $query = Expense::query();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where('concepto', 'like', "%{$search}%")
                  ->orWhere('proveedor', 'like', "%{$search}%");
        }

        if ($request->filled('categoria')) {
            $query->where('categoria', $request->categoria);
        }

        if ($request->filled('metodo_pago')) {
            $query->where('metodo_pago', $request->metodo_pago);
        }

        if ($request->filled('fecha_desde')) {
            $query->whereDate('fecha', '>=', $request->fecha_desde);
        }

        if ($request->filled('fecha_hasta')) {
            $query->whereDate('fecha', '<=', $request->fecha_hasta);
        }

        $expenses = $query->orderBy('fecha', 'desc')->paginate(20);

        $totalGastado = $query->clone()->sum('monto');
        $categorias = ['Material escolar', 'Papelería', 'Servicios', 'Internet', 'Agua', 'Luz', 'Renta', 'Sueldos', 'Mantenimiento', 'Otros'];
        $metodos = ['Efectivo', 'Transferencia', 'Tarjeta', 'Cheque', 'Otro'];

        $gastosPorCategoria = $query->clone()
            ->selectRaw('categoria, SUM(monto) as total')
            ->groupBy('categoria')
            ->pluck('total', 'categoria');

        return view('expenses.index', compact('expenses', 'totalGastado', 'categorias', 'metodos', 'gastosPorCategoria'));
    }

    public function create()
    {
        $categorias = ['Material escolar', 'Papelería', 'Servicios', 'Internet', 'Agua', 'Luz', 'Renta', 'Sueldos', 'Mantenimiento', 'Otros'];
        $metodos = ['Efectivo', 'Transferencia', 'Tarjeta', 'Cheque', 'Otro'];
        return view('expenses.create', compact('categorias', 'metodos'));
    }

    public function store(StoreExpenseRequest $request)
    {
        Expense::create($request->validated());

        return redirect()->route('expenses.index')
            ->with('success', 'Gasto registrado correctamente.');
    }

    public function show(Expense $expense)
    {
        return view('expenses.show', compact('expense'));
    }

    public function edit(Expense $expense)
    {
        $categorias = ['Material escolar', 'Papelería', 'Servicios', 'Internet', 'Agua', 'Luz', 'Renta', 'Sueldos', 'Mantenimiento', 'Otros'];
        $metodos = ['Efectivo', 'Transferencia', 'Tarjeta', 'Cheque', 'Otro'];
        return view('expenses.edit', compact('expense', 'categorias', 'metodos'));
    }

    public function update(UpdateExpenseRequest $request, Expense $expense)
    {
        $expense->update($request->validated());

        return redirect()->route('expenses.index')
            ->with('success', 'Gasto actualizado correctamente.');
    }

    public function destroy(Expense $expense)
    {
        $expense->delete();

        return redirect()->route('expenses.index')
            ->with('success', 'Gasto eliminado correctamente.');
    }
}
