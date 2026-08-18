<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('teachers', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('apellido_paterno');
            $table->string('apellido_materno');
            $table->date('fecha_nacimiento');
            $table->string('curp', 18)->nullable()->unique();
            $table->enum('sexo', ['Masculino', 'Femenino']);
            $table->text('direccion');
            $table->string('telefono', 20);
            $table->string('correo')->nullable();
            $table->string('especialidad');
            $table->string('cedula_profesional')->nullable();
            $table->date('fecha_ingreso');
            $table->enum('estado', ['Activo', 'Inactivo'])->default('Activo');
            $table->string('fotografia')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('teachers');
    }
};
