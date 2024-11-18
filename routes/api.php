<?php

use App\Http\Controllers\AsientoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SalaController;

Route::get('/', function() {
    return view('welcome');
});

//---------------------------------------
//todo renombrar las rutas, separar validación y controlador??, toast, delete on cascade de asientos, si no valida lanza error, si valida ejecuta controlador pero si hay algún error en la consulta o asi? hay que retonar una vista + json creo q es se va requerir? + !toastjs? | -get() te da una conjunto a pesar d q se usa con where, metodos no funcionan con conjuntos

//?actualizar sala es necesarii

//----------------------------------------salas

//select all
Route::get('/select_salas', [SalaController::class, 'select_salas'])->name('select_salas');

//select sala y sus asientos por id
Route::get('/select_sala_id/{id}',  [SalaController::class, 'select_sala_id'])->name('select_sala_id');

//insert sala por titulo
Route::get('/insert_sala_titulo/{titulo}',  [SalaController::class, 'insert_sala_titulo'])->name('insertar_sala_titulo');

//!colision /el_sala/{param}
//eliminar sala por titulo
Route::get('/delete_sala_titulo/{titulo}',  [SalaController::class, 'delete_sala_titulo'])->name('delete_sala_titulo');

//eliminar sala por id
Route::get('/delete_sala_id/{id}',  [SalaController::class, 'delete_sala_id'])->name('delete_sala_id');

//----------------------------------------asientos


//update estado asiento por id (reservar) 
Route::get('/reservar_asiento/{id}',  [AsientoController::class, 'update_reservar_asiento'])->name('reservar_asiento');  

//update estado asiento por id (anular reserva) 
Route::get('/anular_reserva_asiento/{id}',  [AsientoController::class, 'update_anular_reserva_asiento'])->name('anular_reserva_asiento');