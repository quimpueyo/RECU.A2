<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DuenoController;
use App\Http\Controllers\AnimalController;

// Rutas de la API

// Crud de Dueños
Route::apiResource('duenos', DuenoController::class);

// Crud de Animales
Route::apiResource('animales', AnimalController::class);
