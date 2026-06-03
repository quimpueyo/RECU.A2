<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

function testApi($method, $uri, $data = []) {
    global $kernel;
    $request = Illuminate\Http\Request::create($uri, $method, $data);
    $request->headers->set('Accept', 'application/json');
    $response = $kernel->handle($request);
    echo "[$method $uri] -> Status: " . $response->getStatusCode() . "\n";
    echo $response->getContent() . "\n\n";
    return json_decode($response->getContent(), true);
}

echo "=== INICIANDO PRUEBAS ===\n";

// 1. Listar dueños
testApi('GET', '/api/duenos');

// 2. Crear dueño
$dueno = testApi('POST', '/api/duenos', ['nombre' => 'Juan', 'apellido' => 'Perez']);
$duenoId = $dueno['id'] ?? 1;

// 3. Listar animales
testApi('GET', '/api/animales');

// 4. Crear animal
$animal = testApi('POST', '/api/animales', [
    'nombre' => 'Firulais',
    'tipo' => 'perro',
    'peso' => 12.5,
    'dueno_id' => $duenoId
]);
$animalId = $animal['id'] ?? 1;

// 5. Mostrar animal
testApi('GET', '/api/animales/' . $animalId);

// 6. Actualizar animal
testApi('PUT', '/api/animales/' . $animalId, [
    'nombre' => 'Firulais Modificado',
    'tipo' => 'gato',
    'peso' => 10.0
]);

// 7. Eliminar dueño
testApi('DELETE', '/api/duenos/' . $duenoId);

// 8. Comprobar eliminación en cascada (listar animales de nuevo)
// Buscar el animal específico para ver si se borró
testApi('GET', '/api/animales/' . $animalId);

echo "=== PRUEBAS FINALIZADAS ===\n";
