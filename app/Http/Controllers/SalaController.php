<?php

namespace App\Http\Controllers;

use App\Models\Sala;
use Illuminate\Http\Request;

class SalaController extends Controller
{
   public function select(){
        
        $salas = Sala::all();
        return response()->json($salas, 200);
        // return redirect()->route()->
   }
}
