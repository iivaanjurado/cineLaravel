<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SalaController;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/cartelera', function () {
    return view('cartelera');
});

Route::get('/insertar-sala', function () {
    return view('insertarSala');
});

Route::get('/eliminar-sala', function () {
    return view('eliminarSala');
});

Route::get('/modificar-sala', function () {
    return view('modificarSala');
});

Route::get('/asientos', function () {
    return view('asientos');
});
// -----------------------rutas api-controlador

Route::get('/demo_select', [SalaController::class, 'select']);

