<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SalaController;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/prueba', function () {
    return view('vistaPrueba');
});


// -----------------------rutas api-controlador

Route::get('/demo_select', [SalaController::class, 'select']);
