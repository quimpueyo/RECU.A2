<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Limpiar tablas antes (opcional, pero útil)
        // Desactivar foreign keys check para truncar
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('animales')->truncate();
        DB::table('duenos')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // Insertar Dueños
        $duenoId1 = DB::table('duenos')->insertGetId([
            'nombre' => 'Juan',
            'apellido' => 'Pérez',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        $duenoId2 = DB::table('duenos')->insertGetId([
            'nombre' => 'Ana',
            'apellido' => 'García',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        // Insertar Animales
        DB::table('animales')->insert([
            [
                'nombre' => 'Firulais',
                'tipo' => 'perro',
                'peso' => 12.50,
                'enfermedad' => null,
                'comentarios' => 'Vacunado contra la rabia',
                'dueno_id' => $duenoId1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nombre' => 'Michi',
                'tipo' => 'gato',
                'peso' => 4.20,
                'enfermedad' => 'Otitis',
                'comentarios' => 'Requiere revisión en 1 semana',
                'dueno_id' => $duenoId1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nombre' => 'Bugs',
                'tipo' => 'conejo',
                'peso' => 1.50,
                'enfermedad' => null,
                'comentarios' => 'Come zanahorias',
                'dueno_id' => $duenoId2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        ]);
    }
}
