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


// -----------------------rutas api-controlador

Route::get('/demo_select', [SalaController::class, 'select']);
