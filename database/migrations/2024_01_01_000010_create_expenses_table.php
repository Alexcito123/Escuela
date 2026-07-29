<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('expenses', function (Blueprint $table) {
            $table->id();
            $table->string('concepto');
            $table->enum('categoria', [
                'Material escolar', 'Papelería', 'Servicios', 'Internet',
                'Agua', 'Luz', 'Renta', 'Sueldos', 'Mantenimiento', 'Otros',
            ]);
            $table->decimal('monto', 10, 2);
            $table->date('fecha');
            $table->string('proveedor')->nullable();
            $table->enum('metodo_pago', ['Efectivo', 'Transferencia', 'Tarjeta', 'Cheque', 'Otro'])->default('Efectivo');
            $table->text('observaciones')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('expenses');
    }
};
