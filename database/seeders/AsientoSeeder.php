<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Asiento;
use App\Models\Sala;


class AsientoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $salas = Sala::all(); 
        $numFilas = 5;
        $numColumnas = 10; 
        $estado=false;

        foreach ($salas as $sala) {
            for ($fila = 1; $fila <= $numFilas; $fila++) {
                for ($col = 1; $col <= $numColumnas; $col++) {
                    $sala->asientos()->create([
                        'fila' => $fila,
                        'columna' => $col,
                        'reservado' => $estado,
                    ]);
                }
            }
        }
    }
}

