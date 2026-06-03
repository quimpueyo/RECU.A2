<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Dueno;
use App\Models\Animal;

// Rutas de la API

// ==========================================
// CRUD DE DUEÑOS
// ==========================================

// Muestra todos los dueños registrados.
Route::get('duenos', function () {
    $duenos = Dueno::all();
    return response()->json($duenos);
});

// Crea un nuevo dueño.
Route::post('duenos', function (Request $request) {
    $request->validate([
        'nombre' => 'required|string',
        'apellido' => 'required|string',
    ]);
    $dueno = Dueno::create($request->all());
    return response()->json($dueno, 201);
});

// Muestra un dueño en detalle.
Route::get('duenos/{id}', function ($id) {
    $dueno = Dueno::find($id);
    if (!$dueno) {
        return response()->json(['message' => 'Dueño no encontrado'], 404);
    }
    return response()->json($dueno);
});

// Modifica los datos de un dueño.
Route::put('duenos/{id}', function (Request $request, $id) {
    $dueno = Dueno::find($id);
    if (!$dueno) {
        return response()->json(['message' => 'Dueño no encontrado'], 404);
    }
    $request->validate([
        'nombre' => 'required|string',
        'apellido' => 'required|string',
    ]);
    $dueno->update($request->all());
    return response()->json($dueno);
});

// Borra un dueño.
Route::delete('duenos/{id}', function ($id) {
    $dueno = Dueno::find($id);
    if (!$dueno) {
        return response()->json(['message' => 'Dueño no encontrado'], 404);
    }
    $dueno->delete();
    return response()->json(['message' => 'Dueño eliminado correctamente']);
});

// ==========================================
// CRUD DE ANIMALES
// ==========================================

// Muestra el listado de todos los animales.
Route::get('animales', function () {
    $animales = Animal::all();
    return response()->json($animales);
});

// Guarda un nuevo animal en la base de datos.
Route::post('animales', function (Request $request) {
    $request->validate([
        'nombre' => 'required|string',
        'tipo' => 'required|in:perro,gato',
        'peso' => 'required|numeric',
        'dueno_id' => 'required|exists:duenos,id',
    ]);
    $animal = Animal::create($request->all());
    return response()->json($animal, 201);
});

// Muestra la información de un animal concreto por su ID.
Route::get('animales/{id}', function ($id) {
    $animal = Animal::find($id);
    if (!$animal) {
        return response()->json(['message' => 'Animal no encontrado'], 404);
    }
    return response()->json($animal);
});

// Actualiza los datos de un animal existente.
Route::put('animales/{id}', function (Request $request, $id) {
    $animal = Animal::find($id);
    if (!$animal) {
        return response()->json(['message' => 'Animal no encontrado'], 404);
    }
    $request->validate([
        'nombre' => 'required|string',
        'tipo' => 'required|in:perro,gato',
        'peso' => 'required|numeric',
        'dueno_id' => 'exists:duenos,id',
    ]);
    $animal->update($request->all());
    return response()->json($animal);
});

// Elimina un animal de la base de datos.
Route::delete('animales/{id}', function ($id) {
    $animal = Animal::find($id);
    if (!$animal) {
        return response()->json(['message' => 'Animal no encontrado'], 404);
    }
    $animal->delete();
    return response()->json(['message' => 'Animal eliminado correctamente']);
});
