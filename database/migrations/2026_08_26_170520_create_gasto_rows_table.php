<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('gasto_rows', function (Blueprint $table) {
            $table->id();
            $table->foreignId('gasto_week_id')->constrained()->cascadeOnDelete();
            $table->string('alumno')->default('');
            $table->string('pago_semanal')->default('');
            $table->string('mensual')->default('');
            $table->string('columna1')->default('');
            $table->string('gastos_semana')->default('');
            $table->string('pendientes_pagar')->default('');
            $table->integer('row_order')->default(0);
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gasto_rows');
    }
};
