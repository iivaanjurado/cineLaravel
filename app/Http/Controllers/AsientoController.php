<?php

namespace App\Http\Controllers;

use App\Models\Sala;
use App\Models\Asiento;
use Illuminate\Http\Request;

class AsientoController extends Controller
{
    //generar e insertar registros con fk
    public function insert_asientos($sala){
        
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
    public function update_reservar_asiento($id){
        
        //recupero el asiento, no dejo a la consulta seguir trabajando, si no existe otro registro mismo id, no tiene sentido seguir
        $asiento = Asiento::where('id', $id)->first();

        //check consulta, como solo da el registro no se puede usar is_Empty
        if(is_null($asiento)){
            $data = [
                'message' => ' No se encontró ningún asiento con ese id',
            ];

            return response()->json($data, 200);

        }else{

            //actualizo el estado del registro
            $asiento->reservado = true;

            //lo almaceno modificado
            $b = $asiento->save();

            if($b){
                
                //devuevo el mismo registro, actualizado en logica, no recuperado de la bbdd, es igual

                $data = [
                    'message' => 'Asiento actualizado con éxito',
                    'asiento' => $asiento,
                ];
    
                return response()->json($data, 200);

            }else{
                
                $data = [
                    'message' => 'Error al actualizar el asiento',
                ];

                return response()->json($data, 400);
            }
        }
    }


    //actualiza el estado de un registro por su id
    public function update_anular_reserva_asiento($id){
        
        //recupero el asiento, no dejo a la consulta seguir trabajando, si no existe otro registro mismo id, no tiene sentido seguir
        $asiento = Asiento::where('id', $id)->first();

        //check consulta, como solo da el registro no se puede usar is_Empty
        if(is_null($asiento)){
            $data = [
                'message' => ' No se encontró ningún asiento con ese id',
            ];

            return response()->json($data, 200);

        }else{

            //actualizo el estado del registro
            $asiento->reservado = false;

            //lo almaceno modificado
            $b = $asiento->save();

            if($b){
                
                //devuevo el mismo registro, actualizado en logica, no recuperado de la bbdd, es igual

                $data = [
                    'message' => 'Asiento actualizado con éxito',
                    'asiento' => $asiento,
                ];
    
                return response()->json($data, 200);

            }else{
                
                $data = [
                    'message' => 'Error al actualizar el asiento',
                ];

                return response()->json($data, 400);
            }
        }
    }

}
