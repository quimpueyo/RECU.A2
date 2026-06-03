<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Ejecuta las migraciones para crear la tabla de animales.
     */
    public function up(): void
    {
        Schema::create('animales', function (Blueprint $table) {
            $table->id(); // Id autonumérico del animal
            
            // Campos definidos en el enunciado
            $table->string('nombre'); // Nombre del animal (obligatorio)
            $table->string('tipo'); // Tipo de animal (ej: perro, gato)
            $table->decimal('peso', 8, 2); // Peso en decimal
            $table->string('enfermedad')->nullable(); // Enfermedad (opcional)
            $table->text('comentarios')->nullable(); // Texto largo (opcional)
            
            // Relación con el dueño. 
            // onDelete('cascade') asegura que si se borra el dueño, se borran sus animales.
            $table->foreignId('dueno_id')->constrained('duenos')->onDelete('cascade');
            
            $table->timestamps(); // Campos created_at y updated_at
        });
    }

    /**
     * Revierte la migración eliminando la tabla.
     */
    public function down(): void
    {
        Schema::dropIfExists('animales');
    }
};
