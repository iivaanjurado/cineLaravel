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
        } else {

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
            'id' => ' exists:salas,id'
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
            } elseif ($asientos->isEmpty()) {
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

    public function insertar_sala(Request $request)
    {

        //get datos del request (valor atributo name en inputs front)
        $titulo = $request->input('titulo');
        $sinopsis = $request->input('sinopsis');
        $enlace = $request->input('enlace');

        /* $titulo = 'lapeliculanueva';
        $sinopsis = 'vetesaber';
        $enlace = 'hhtp//;ss'; */

        //valido la entrada
        // $validator = Validator::make($request->all())
        $validator = Validator::make(['pelicula' => $titulo, 'sinopsis' => $sinopsis, 'enlaceImg' => $enlace], [
            'pelicula' => 'required | string | max:255 | unique:salas,pelicula' ,
            'sinopsis' => 'required | string | max:255',
            'enlaceImg' => 'required | url | string | max:255'
        ], []);


        if ($validator->fails()) {

            $data = [
                'message' => 'Error en la validación',
                'errors' => $validator->errors()

            ];

            return response()->json($data, 200);

        } else { //validacion correcta

            //insert registro sala y asientos

            $sala = new Sala();

            //seteo los valores que recibo por paámetro (ya validados), id autoincrementado
            $sala->pelicula = $titulo;
            $sala->sinopsis = $sinopsis;
            $sala->enlaceImg = $enlace;

            //lo guardo
            $sala->save();

            //con tabla sala creada, creo tabla asientos

            //necesito de un método en el controlador de asientos para generar los registros, instancio el controllador
            $asientoController = new AsientoController();

            // genero los registros asientos, a partir de un metodo del controlador, usando el id de la sala generada para la fk idSala
            $asientoController->insert_asientos($sala);


            //elaboro  respuesta json con la nueva sala creada y sus asientos

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
            } elseif ($asientos->isEmpty()) {
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

    //todo modificar y eliminar

    //insert sala y sus asientos por titulo
    public function insert_sala_titulo($titulo)
    {

        //hago la validacion
        $validator = Validator::make(['titulo' => $titulo], [

            'titulo' => 'string | max:255 |unique:salas,titulo'
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
            $asientoController = new AsientoController();

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

            } elseif ($asientos->isEmpty()) {
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

    //update campos de sala por request
    public function update_sala(Request $request){

        //get datos del request (valor atributo name en inputs front)
        $id = $request['id'];
        $titulo = $request['titulo'];
        $sinopsis = $request['sinopsis'];
        $enlace = $request['enlace'];

        /* $id = 5;
        $titulo = 'Interstellar 2';
        $sinopsis = 'Vuelve intelesstelar';
        $enlace = 'https://dubaitickets.tours/wp-content/uploads/2023/03/img-worlds-of-adventure-dubai-ticket-9.jpg'; */


        //valido la entrada
        // $validator = Validator::make($request->all())
        $validator = Validator::make($request->all(), [
            'titulo' => 'required | string | max:255',
            'sinopsis' => 'required | string | max:255',
            'enlace' => 'required | string | max:255'
        ]);


        if ($validator->fails()) {

            $data = [
                'message' => 'Error en la validación',
                'errors' => $validator->errors()

            ];

            return response()->json($data, 200);

        }else{//validacion correcta

            //recupero el registro
            $sala = Sala::where('id', $id)->first();

            if (is_null($sala)) {

                $data = [
                    'message' => 'No se encontró ninguna sala',
                ];

                return response()->json($data, 200);

            } else {//si encuentra la sala

                $sala->pelicula = $titulo;
                $sala->sinopsis = $sinopsis;
                $sala->enlaceImg = $enlace;

                $b = $sala->save();

                if ($b) {

                    $data = [
                        'message' => 'Sala actualizada con éxito'
                    ];

                    return response()->json($data, 200);

                } else {

                    $data = [
                        'message' => 'Error en la consulta, sala no actualizada'
                    ];

                    return response()->json($data, 200);

                }
            }
        }
    }

    /////?delete on cascade?
    //eliminar sala y sus asientos por titulo

    public function delete_sala_titulo($titulo)
    {

        //valido que el titulo exista en la tabla salas, ademas de que sea formato string

        $validator = Validator::make(['titulo' => $titulo], [

            //formato valido y exists
            'titulo' => 'string|max:255|exists:salas,pelicula'
        ]);


        if ($validator->fails()) {

            //manipulo respuesta e incluyo los errores de validación q lanza laravel
            $data = [
                'message' => 'Error en la validación de datos',
                'errors' => $validator->errors(),
                'success' => false
            ];

            //retorno respuesta json + codigo error en la solicitud
            return response()->json($data, 400);
        } else { //si validación correcta

            //elimino la tabla que corresponda al id, asientos se eliminan por cascade
            $sala = Sala::where('pelicula', $titulo)->first();
            $sala->delete();

            $data = [
                'message' => 'Sala eliminada con éxito',
                'success' => true
            ];

            return response()->json($data, 200);
        }
    }

    public function delete_sala_id($id)
    {

        //valido que el id exista en la tabla salas, si existen en salas existe en asientos
        $validator = Validator::make(['id' => $id], [
            'id' => 'exists:salas,id'
        ]);

        if ($validator->fails()) {

            //manipulo respuesta e incluyo los errores de validación q lanza laravel
            $data = [
                'message' => 'Error en la validación de datos',
                'errors' => $validator->errors(),
                'success' => false
            ];

            //retorno respuesta json + codigo error en la solicitud
            return response()->json($data, 400);

        } else { //si validación correcta

            //elimino la tabla que corresponda al id, asientos se eliminan por cascade

            //recupero la sala
            $sala = Sala::where('id', $id)->first();

            //check consulta
            if (is_null($sala)) {

                //manipulo respuesta
                $data = [
                    'errors' => ' No se encontró ninguna sala con ese id',
                    'success' => false
                ];

                //retorno respuesta json + codigo estado solicitud exitosa
                return response()->json($data, 200);

            } else {
                //elimino asientos de la tabla antes por restricción (no delete on cascade)
                // Asiento::where('idSala', $id)->delete();

                //la elimino, delete no funciona con el conjunto d datos, necesita el registro (frist())
                $sala->delete();

                //elaboro el array de respuesta
                $data = [
                    'message' => 'Sala eliminada con éxito',
                    'success' => true
                ];

                //retorno respuesta json + codigo estado solicitud exitosa
                return response()->json($data, 200);
            }
        }
    }


}
