<?php

namespace App\Http\Controllers;

use App\Models\Animal;
use Illuminate\Http\Request;

class AnimalController extends Controller
{
    /**
     * Muestra el listado de todos los animales.
     * Devuelve un JSON con los datos.
     */
    public function index()
    {
        // Obtenemos todos los registros de la tabla 'animales'
        $animales = Animal::all();
        // Devolvemos la respuesta en formato JSON
        return response()->json($animales);
    }

    /**
     * Guarda un nuevo animal en la base de datos.
     */
    public function store(Request $request)
    {
        // 1. Validamos que los datos recibidos sean correctos
        $request->validate([
            'nombre' => 'required|string', // Obligatorio y tipo texto
            'tipo' => 'required|in:perro,gato,hámster,conejo', // Solo permitimos estos valores
            'peso' => 'required|numeric', // Debe ser un número
            'dueno_id' => 'required|exists:duenos,id', // El dueño debe existir en su tabla
        ]);

        // 2. Si pasa la validación, creamos el animal
        $animal = Animal::create($request->all());

        // 3. Devolvemos el animal creado y código 201 (Creado)
        return response()->json($animal, 201);
    }

    /**
     * Muestra la información de un animal concreto por su ID.
     */
    public function show($id)
    {
        // Buscamos el animal por su ID
        $animal = Animal::find($id);

        // Si no existe, devolvemos un error 404
        if (!$animal) {
            return response()->json(['message' => 'Animal no encontrado'], 404);
        }

        // Si existe, lo devolvemos
        return response()->json($animal);
    }

    /**
     * Actualiza los datos de un animal existente.
     */
    public function update(Request $request, $id)
    {
        // Buscamos el animal a editar
        $animal = Animal::find($id);

        if (!$animal) {
            return response()->json(['message' => 'Animal no encontrado'], 404);
        }

        // Validamos los datos nuevos
        // Nota: 'dueno_id' es opcional en el update, pero si viene debe existir
        $request->validate([
            'nombre' => 'required|string',
            'tipo' => 'required|in:perro,gato,hámster,conejo',
            'peso' => 'required|numeric',
            'dueno_id' => 'exists:duenos,id',
        ]);

        // Actualizamos el registro con los nuevos datos
        $animal->update($request->all());

        return response()->json($animal);
    }

    /**
     * Elimina un animal de la base de datos.
     */
    public function destroy($id)
    {
        $animal = Animal::find($id);

        if (!$animal) {
            return response()->json(['message' => 'Animal no encontrado'], 404);
        }

        // Lo borramos
        $animal->delete();

        return response()->json(['message' => 'Animal eliminado correctamente']);
    }
}
