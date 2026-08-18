<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Student;
use App\Models\Grade;
use App\Http\Requests\StorePaymentRequest;
use App\Http\Requests\UpdatePaymentRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{
    public function index(Request $request)
    {
        $query = Payment::query()->with('student.grade');

        if ($request->filled('search')) {
            $search = $request->search;
            $query->whereHas('student', function ($q) use ($search) {
                $q->where('nombre', 'like', "%{$search}%")
                  ->orWhere('apellido_paterno', 'like', "%{$search}%")
                  ->orWhere('apellido_materno', 'like', "%{$search}%");
            });
        }

        if ($request->filled('student_id')) {
            $query->where('student_id', $request->student_id);
        }

        if ($request->filled('concepto')) {
            $query->where('concepto', $request->concepto);
        }

        if ($request->filled('estado')) {
            $query->where('estado', $request->estado);
        }

        if ($request->filled('fecha_desde')) {
            $query->whereDate('fecha', '>=', $request->fecha_desde);
        }

        if ($request->filled('fecha_hasta')) {
            $query->whereDate('fecha', '<=', $request->fecha_hasta);
        }

        $payments = $query->orderBy('fecha', 'desc')->paginate(20);
        $students = Student::orderBy('apellido_paterno')->get();
        $conceptos = ['Inscripción', 'Mensualidad', 'Material', 'Uniforme', 'Evento', 'Otro'];
        $estados = ['Pagado', 'Pendiente', 'Cancelado'];

        $totalPagado = $query->clone()->where('estado', 'Pagado')->sum('monto');
        $totalPendiente = $query->clone()->where('estado', 'Pendiente')->sum('monto');

        return view('payments.index', compact('payments', 'students', 'conceptos', 'estados', 'totalPagado', 'totalPendiente'));
    }

    public function create()
    {
        $students = Student::where('estado', 'Activo')->orderBy('apellido_paterno')->get();
        $conceptos = ['Inscripción', 'Mensualidad', 'Material', 'Uniforme', 'Evento', 'Otro'];
        $metodos = ['Efectivo', 'Transferencia', 'Tarjeta', 'Cheque', 'Otro'];
        return view('payments.create', compact('students', 'conceptos', 'metodos'));
    }

    public function store(StorePaymentRequest $request)
    {
        Payment::create($request->validated());

        return redirect()->route('payments.index')
            ->with('success', 'Pago registrado correctamente.');
    }

    public function show(Payment $payment)
    {
        $payment->load('student.grade');
        return view('payments.show', compact('payment'));
    }

    public function edit(Payment $payment)
    {
        $students = Student::where('estado', 'Activo')->orderBy('apellido_paterno')->get();
        $conceptos = ['Inscripción', 'Mensualidad', 'Material', 'Uniforme', 'Evento', 'Otro'];
        $metodos = ['Efectivo', 'Transferencia', 'Tarjeta', 'Cheque', 'Otro'];
        return view('payments.edit', compact('payment', 'students', 'conceptos', 'metodos'));
    }

    public function update(UpdatePaymentRequest $request, Payment $payment)
    {
        $payment->update($request->validated());

        return redirect()->route('payments.index')
            ->with('success', 'Pago actualizado correctamente.');
    }

    public function destroy(Payment $payment)
    {
        $payment->delete();

        return redirect()->route('payments.index')
            ->with('success', 'Pago eliminado correctamente.');
    }

    public function studentHistory(Student $student)
    {
        $payments = $student->payments()->orderBy('fecha', 'desc')->paginate(20);
        $totalPagado = $student->payments()->where('estado', 'Pagado')->sum('monto');
        $totalPendiente = $student->payments()->where('estado', 'Pendiente')->sum('monto');

        return view('payments.student', compact('student', 'payments', 'totalPagado', 'totalPendiente'));
    }
}
