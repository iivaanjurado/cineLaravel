<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/cartelera', function () {
    return view('cartelera');
});

Route::get('/insertar-sala', function () {
    return view('insertarSala');
});
Route::get('/asientos', function () {
    return view('asientos');
});
Route::get('/eliminar-sala', function () {
    return view('eliminarSala');
});
Route::get('/modificar-sala', function () {
    return view('modificarSala');
});

