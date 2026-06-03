<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dueno extends Model
{
    use HasFactory;

    // Nombre de la tabla explícito
    protected $table = 'duenos';

    // Campos que se pueden asignar masivamente
    protected $fillable = [
        'nombre',
        'apellido',
    ];

    /**
     * Relación: Un dueño tiene muchos animales.
     */
    public function animales()
    {
        return $this->hasMany(Animal::class);
    }
}
