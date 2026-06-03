<?php

namespace App\Http\Controllers;

use App\Models\Dueno;
use Illuminate\Http\Request;

class DuenoController extends Controller
{
    /**
     * Muestra todos los dueños registrados.
     */
    public function index()
    {
        // SELECT * FROM duenos
        $duenos = Dueno::all();
        // Devolvemos JSON para la API
        return response()->json($duenos);
    }

    /**
     * Crea un nuevo dueño.
     */
    public function store(Request $request)
    {
        // Validamos que vengan nombre y apellido y sean texto
        $request->validate([
            'nombre' => 'required|string',
            'apellido' => 'required|string',
        ]);

        // Creamos el registro en la BD
        $dueno = Dueno::create($request->all());

        return response()->json($dueno, 201);
    }

    /**
     * Muestra un dueño en detalle.
     */
    public function show($id)
    {
        $dueno = Dueno::find($id);

        if (!$dueno) {
            return response()->json(['message' => 'Dueño no encontrado'], 404);
        }

        return response()->json($dueno);
    }

    /**
     * Modifica los datos de un dueño.
     */
    public function update(Request $request, $id)
    {
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
    }

    /**
     * Borra un dueño.
     * CUIDADO: Al borrarlo, se borran también sus animales (Cascada).
     */
    public function destroy($id)
    {
        $dueno = Dueno::find($id);

        if (!$dueno) {
            return response()->json(['message' => 'Dueño no encontrado'], 404);
        }

        $dueno->delete();

        return response()->json(['message' => 'Dueño eliminado correctamente']);
    }
}
