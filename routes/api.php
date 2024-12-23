<?php

use App\Http\Controllers\AsientoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SalaController;

Route::get('/', function() {
    return view('welcome');
});

//---------------------------------------
///// todo renombrar las rutas, separar validación y controlador-> no, toastjs -> front, delete on cascade de asientos, si no valida lanza error, si valida ejecuta controlador pero si hay algún error en la consulta o asi?->se comprueba de nuevo la consulta. Hay que retonar una vista + json creo q es se va requerir->no, las vistas se hacen con fetch para no recargar. toastjs? ->en front | -get() te da una conjunto a pesar d q se usa con where, metodos no funcionan con conjuntos

/////todo validar titulo existente en bbdd para no insertar

//?actualizar sala es necesarii

//----------------------------------------salas

//select all
Route::get('/select_salas', [SalaController::class, 'select_salas'])->name('select_salas');

//select sala y sus asientos por id
Route::get('/select_sala_id/{id}',  [SalaController::class, 'select_sala_id'])->name('select_sala_id');

//insert sala por titulo
Route::get('/insert_sala_titulo/{titulo}',  [SalaController::class, 'insert_sala_titulo'])->name('insertar_sala_titulo');

//insert sala por request
Route::get('/insert_sala',  [SalaController::class, 'insertar_sala'])->name('insertar_sala');

//update sala por request
Route::post('/update_sala',  [SalaController::class, 'update_sala'])->name('update_sala');

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
