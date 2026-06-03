<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Tabla 'duenos'
        // Guardará la información de las personas (veterinarios/clientes)
        Schema::create('duenos', function (Blueprint $table) {
            $table->id(); // Crea un campo autoincremental 'id' para identificar al dueño
            $table->string('nombre'); // Campo tipo texto para el nombre
            $table->string('apellido'); // Campo tipo texto para el apellido
            $table->timestamps(); // Crea campos 'created_at' y 'updated_at' automáticamente
        });

        // Tabla 'animales'
        // Guardará las mascotas asociadas a los dueños
        Schema::create('animales', function (Blueprint $table) {
            $table->id(); // Identificador único del animal
            $table->string('nombre');

            // Campo tipo 'enum' para limitar los valores permitidos a la lista especificada
            $table->enum('tipo', ['perro', 'gato', 'hámster', 'conejo']);

            $table->decimal('peso', 8, 2); // Número decimal (8 dígitos en total, 2 decimales)
            $table->string('enfermedad')->nullable(); // nullable() permite que este campo esté vacío (null)
            $table->text('comentarios')->nullable(); // Campo de texto largo, también opcional

            // Relación con la tabla 'duenos'
            // 'constrained' verifica que el id exista en 'duenos'
            // 'onDelete cascade' significa que si borramos al dueño, se borran sus animales automáticamente
            $table->foreignId('dueno_id')->constrained('duenos')->onDelete('cascade');

            $table->timestamps();
        });

        // Limpieza: Eliminamos las tablas que trae Laravel por defecto (users, etc)
        // ya que el ejercicio pide usar este archivo para nuestras tablas personalizadas.
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('animales');
        Schema::dropIfExists('duenos');
        // No restauramos users/sessions en el down porque no las necesitamos para este ejercicio
    }
};
