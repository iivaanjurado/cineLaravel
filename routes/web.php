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
