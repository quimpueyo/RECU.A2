<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Dueno;
use App\Models\Animal;

// Rutas de la API

// ==========================================
// CRUD DE DUEÑOS
// ==========================================

// Obtener todos los dueños
Route::get('duenos', function () {
    $duenos = Dueno::all();
    return response()->json($duenos);
});

// Crear un nuevo dueño
Route::post('duenos', function (Request $request) {
    // Comprobar que los datos obligatorios se han enviado
    $request->validate([
        'nombre' => 'required|string',
        'apellido' => 'required|string',
    ]);
    $dueno = Dueno::create($request->all());
    return response()->json($dueno, 201);
});

// Mostrar un dueño concreto
Route::get('duenos/{id}', function ($id) {
    $dueno = Dueno::find($id);
    if (!$dueno) {
        return response()->json(['message' => 'Dueño no encontrado'], 404);
    }
    return response()->json($dueno);
});

// Actualizar los datos de un dueño
Route::put('duenos/{id}', function (Request $request, $id) {
    $dueno = Dueno::find($id);
    if (!$dueno) {
        return response()->json(['message' => 'Dueño no encontrado'], 404);
    }
    // Comprobar que los datos obligatorios se han enviado
    $request->validate([
        'nombre' => 'required|string',
        'apellido' => 'required|string',
    ]);
    $dueno->update($request->all());
    return response()->json($dueno);
});

// Eliminar el dueño seleccionado
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

// Obtener todos los animales
Route::get('animales', function () {
    $animales = Animal::all();
    return response()->json($animales);
});

// Crear un nuevo animal
Route::post('animales', function (Request $request) {
    // Comprobar que los datos obligatorios se han enviado
    $request->validate([
        'nombre' => 'required|string',
        'tipo' => 'required|in:perro,gato',
        'peso' => 'required|numeric',
        'dueno_id' => 'required|exists:duenos,id',
    ]);
    $animal = Animal::create($request->all());
    return response()->json($animal, 201);
});

// Mostrar un animal concreto
Route::get('animales/{id}', function ($id) {
    $animal = Animal::find($id);
    if (!$animal) {
        return response()->json(['message' => 'Animal no encontrado'], 404);
    }
    return response()->json($animal);
});

// Actualizar un animal
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

// Eliminar el animal seleccionado
Route::delete('animales/{id}', function ($id) {
    $animal = Animal::find($id);
    if (!$animal) {
        return response()->json(['message' => 'Animal no encontrado'], 404);
    }
    $animal->delete();
    return response()->json(['message' => 'Animal eliminado correctamente']);
});
