<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return response()->json([
        'estado' => 'OK',
        'mensaje' => 'Servidor API Veterinaria activo',
        'rutas_disponibles' => [
            'animales' => url('/api/animales'),
            'duenos' => url('/api/duenos'),
        ]
    ]);
});
