<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained()->onDelete('cascade');
            $table->decimal('monto', 10, 2);
            $table->date('fecha');
            $table->enum('concepto', ['Inscripción', 'Mensualidad', 'Material', 'Uniforme', 'Evento', 'Otro']);
            $table->text('observaciones')->nullable();
            $table->enum('estado', ['Pagado', 'Pendiente', 'Cancelado'])->default('Pagado');
            $table->enum('metodo_pago', ['Efectivo', 'Transferencia', 'Tarjeta', 'Cheque', 'Otro'])->default('Efectivo');
            $table->string('referencia')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
