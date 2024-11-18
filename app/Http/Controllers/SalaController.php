<?php

namespace App\Http\Controllers;

use App\Models\Sala;
use App\Models\Asiento;
use Illuminate\Http\Request;
use function PHPUnit\Framework\isEmpty;
use Illuminate\Support\Facades\Validator;

class SalaController extends Controller
{
    //select all salas
    public function select_salas()
    {

        //ejecuta la consulta y almacenalá
        $salas = Sala::all();

        //evalúa el contenido y controla flujo
        if ($salas->isEmpty()) {

            //no contiene datos->a piñon modifico la variable
            $data = [
                'message' => 'No se encontraron salas',
                'status' => 200 
            ];

            //retorno respuesta json + codigo respuesta correcto pero no datos
            return response()->json($data, 200);

        }else{

            //elaboro el array respuesta
            $data = [
            'message' => 'Salas recuperadas con éxito',
            'salas' => $salas
        ];

        //retorno respuesta json, con los datos de la consulta
        return response()->json($data, 200);

        }
    }

    
    //select sala y sus asientos por id (url)
    public function select_sala_id($id)
    {

        //valido que el id exista en la tabla salas, si existen en salas existe en asientos
        //param1(data), param2(rules), param3(messages)
        $validator = Validator::make(['id' => $id], [
            'id' => 'required | exists:salas,id'
        ]);

        if ($validator->fails()) {

            //manipulo respuesta e incluyo los errores de validación q lanza laravel
            $data = [
                'message' => 'Error en la validación de datos',
                'errors' => $validator->errors()
            ];

            //retorno respuesta json + codigo error en la solicitud
            return response()->json($data, 400);

        } else { //si validación correcta

            //consulto salas filtrado (param)
            $sala = Sala::where('id', $id)->get();
            //consulto asientos correspondientes a la sala
            $asientos = Asiento::where('idSala', $id)->get();

            //check consultas
            if ($sala->isEmpty()) {

                //manipulo respuesta
                $sala = [
                    'message' => ' No se encontró ninguna sala con ese id',
                    'status' => 200
                ];

            }elseif($asientos->isEmpty()){
                $asientos = [
                    'message' => ' No se encontraron asientos para esa sala',
                    'status' => 200
                ];
            }

            //elaboro el array de respuesta
            $data = [
                'message' => 'Sala recuperada con éxito',
                'sala' => $sala,
                'asientos' => $asientos
            ];

            //retorno respuesta + codigo estado solicitud exitosa
            return response()->json($data, 200);
        }

    }


    //insert sala y sus asientos por titulo
    public function insert_sala_titulo($titulo)
    {

        //hago la validacion
        $validator = Validator::make(['titulo' => $titulo], [
        
            'titulo' => 'required|string|max:255'
        ]);

        //check validación
        if ($validator->fails()) {

            //manipulo respuesta e incluyo los errores de validación q lanza laravel
            $data = [
                'message' => 'Error en la validación de datos',
                'errors' => $validator->errors()
            ];

            //retorno respuesta json + codigo error en la solicitud
            return response()->json($data, 400);


        } else { //si validación correcta

            //insert registro sala y registros asientos

            //creo registro sala
            $sala = new Sala();

            //seteo los valores que recibo por paámetro (ya validados), id autoincrementado
            $sala->pelicula = $titulo;

            //?podria gettear el id de la sala en éste punto? no hay store asiq no se ha generado, si save la variable no conoce aun el valor, hay que hacer select (143)
            //guardo 
            $sala->save();

            //con tabla sala creada, creo tabla asientos

            //necesito de un método en el controlador de asientos para generar los registros, instancio el controllador
            $asientoController= new AsientoController();

            //llamo al métodoque contiene para generar los registros, usando el id de la sala generada para la fk idSala
            $asientoController->insert_asientos($sala);


            //retorno respuesta json con la nueva sala creada y sus asientos
            //recupero la sala creada
            $sala = Sala::where('pelicula', $titulo)->get();
            $asientos = Asiento::where('idSala', $sala[0]->id)->get();
            
            //check consultas
            if ($sala->isEmpty()) {

                //manipulo respuesta
                $sala = [
                    'message' => ' No se encontró ninguna sala con ese id',
                    'status' => 200
                ];

                
            }elseif($asientos->isEmpty()){
                $asientos = [
                    'message' => ' No se encontraron asientos para esa sala',
                    'status' => 200
                ];
            }

            //elaboro el array de respuesta
            $data = [
                'message' => 'Sala creada con éxito',
                'sala' => $sala,
                'asientos' => $asientos
            ];

            //retorno respuesta + codigo estado solicitud exitosa
            return response()->json($data, 200);
        }
    }

    //eliminar sala y sus asientos por titulo
    //?delete on cascade?

    public function delete_sala_titulo($titulo){
        
        //valido que el titulo exista en la tabla salas, ademas de que sea formato string

        $validator = Validator::make(['titulo' => $titulo], [
        
            //formato valido y exists
            'titulo' => 'required|string|max:255|exists:salas,pelicula'
        ]);


        if($validator->fails()){

            //manipulo respuesta e incluyo los errores de validación q lanza laravel
            $data = [
                'message' => 'Error en la validación de datos',
                'errors' => $validator->errors()
            ];

            //retorno respuesta json + codigo error en la solicitud
            return response()->json($data, 400);

        }else{//si validación correcta

            //elimino la tabla que corresponda al id, asientos se eliminan por cascade
            $sala = Sala::where('pelicula', $titulo)->first();
            $sala->delete();

            $data= [
                'message' => 'Sala eliminada con éxito',
            ];

            return response()->json($data, 200);

        }
    }

    public function delete_sala_id($id){
        
        //valido que el id exista en la tabla salas, si existen en salas existe en asientos
        $validator = Validator::make(['id' => $id], [
            'id' => 'required | exists:salas,id'
        ]);

        if($validator->fails()){

                //manipulo respuesta e incluyo los errores de validación q lanza laravel
                $data = [
                    'message' => 'Error en la validación de datos',
                    'errors' => $validator->errors()
                ];

                //retorno respuesta json + codigo error en la solicitud
                return response()->json($data, 400);

        }else{//si validación correcta

            //elimino la tabla que corresponda al id, asientos se eliminan por cascade

            //recupero la sala
            $sala = Sala::where('id', $id)->first();

            //check consulta
            if (is_null($sala)) {

                //manipulo respuesta
                $data = [
                    'message' => ' No se encontró ninguna sala con ese id',
                ];

                //retorno respuesta json + codigo estado solicitud exitosa
                return response()->json($data, 200);

            }else{

                //la elimino, delete no funciona con el conjunto d datos, necesita el registro
                $sala->delete();

                //elaboro el array de respuesta
                $data= [
                    'message' => 'Sala eliminada con éxito',
                ];
                
                //retorno respuesta json + codigo estado solicitud exitosa
                return response()->json($data, 200);
            }
        }
    }

}