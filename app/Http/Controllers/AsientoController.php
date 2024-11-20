<?php

namespace App\Http\Controllers;

use App\Models\Sala;
use App\Models\Asiento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AsientoController extends Controller
{
    //generar e insertar registros con fk
    public function insert_asientos($sala)
    {

        //reutilizo la logica del asientoSeeder, registros para 1 sola sala, uso el id de esta para la fk

        //!no hay tablas con asientos  para cada sala, solo hay una tabla asientos que contiene los registros de todas las salas, clasificados por idSala

        $numFilas = 5;
        $numColumnas = 10;
        $estado = false;

        for ($fila = 1; $fila <= $numFilas; $fila++) {
            for ($col = 1; $col <= $numColumnas; $col++) {

                //creo el registro
                $asiento = Asiento::create([
                    'fila' => $fila,
                    'columna' => $col,
                    'reservado' => $estado,
                    'idSala' => $sala->id,
                ]);

                //almaceno en bbdd
                $asiento->save();
            }
        }
    }


    //actualiza el estado de un registro por su id
    public function update_reservar_asiento($id)
    {

        //validación
        $validator = Validator::make(['idSala', $id], [
            'idSala' => 'exists:asientos,idSala'
        ], []);

        //check validación
        if ($validator->fails()) {

            //elaboro respuesta
            $data = [
                'message' => 'Error en la validación de datos',
                'errors' => $validator->errors()
            ];

            //retorno respuesta + codigo d error n la solicitud
            return response()->json($data, 400);
        } else { //validacion correcta

            //recupero el asiento, no dejo a la consulta seguir trabajando, si no existe otro registro mismo id, no tiene sentido seguir
            $asiento = Asiento::where('id', $id)->first();

            //check consulta, como solo da el registro no se puede usar is_Empty
            if (is_null($asiento)) {

                $data = [
                    'message' => ' Error en la consulta, no se encontró ningún asiento con ese id',
                ];

                return response()->json($data, 200);
            } else { //asiento recuperado 

                //check si ya está reservado   
                if ($asiento->reservado == true) {

                    //elaboro el mensaje
                    $data = [
                        'message' => 'Error al actualizar, el asiento ya está reservado'
                    ];

                    //retorno respuesta
                    return response()->json($data, 200);
                } else { //asiento recuperado y no reservado

                    //actualizo el estado del registro
                    $asiento->reservado = true;

                    //lo almaceno modificado
                    $b = $asiento->save();


                    if ($b) { //si se almacena

                        //devuevo el mismo registro, actualizado en codigo, no recuperado de la bbdd, es igual

                        $data = [
                            'message' => 'Asiento actualizado con éxito',
                            'asiento' => $asiento,
                        ];

                        return response()->json($data, 200);
                    } else { //que no se almacena

                        $data = [
                            'message' => 'Error al actualizar el asiento',
                        ];

                        return response()->json($data, 400);
                    }
                }
            }
        }
    }


    //actualiza el estado de un registro por su id
    public function update_anular_reserva_asiento($id)
    {

        //instancia validación
        $validator = Validator::make(['id', $id], [
            'id' => ' exists:asientos,idSala'
        ], []);

        //check validación
        if ($validator->fails()) {

            $data = [
                'message' => 'Error en la validación',
                'errors' => $validator->errors()
            ];

            return response()->json($data, 400);

        } else { //validación correcta

            //recupero el asiento, no dejo a la consulta seguir trabajando, si no existe otro registro mismo id, no tiene sentido seguir
            $asiento = Asiento::where('id', $id)->first();

            //check consulta, como solo da el registro no se puede usar is_Empty
            if (is_null($asiento)) {

                $data = [
                    'message' => ' Error en la consulta, no se encontró ningún asiento con ese id'
                ];

                return response()->json($data, 200);

            } else { //asiento recuperado

                if ($asiento->reservado == false) {

                    $data = [
                        'message' => 'Error al actualizar, el asiento ya está reservado'
                    ];

                    return response()->json($data, 400);
                    
                } else {

                    //actualizo el estado del registro
                    $asiento->reservado = false;

                    //lo almaceno modificado
                    $b = $asiento->save();

                    if ($b) {//si se almacena

                        //devuevo el mismo registro, actualizado en logica, no recuperado de la bbdd, es igual

                        $data = [
                            'message' => 'Asiento actualizado con éxito',
                            'asiento' => $asiento,
                        ];

                        return response()->json($data, 200);

                    } else {//no se almacena

                        $data = [
                            'message' => 'Error al actualizar el asiento',
                        ];

                        return response()->json($data, 400);

                    }
                }
            }
        }
    }
}
