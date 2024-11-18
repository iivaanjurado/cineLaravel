<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Sala>
 */
class SalaFactory extends Factory
{
    protected $peliculas = [
        'American Pie',
        'Torrente: El brazo tonto de la ley',
        'Garfield',
        'Interstellar',
        'Frozen',
        'Scary Movie',
        'Regreso al futuro',
        'Niños grandes'
    ];

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        
        $pelicula = array_pop($this->peliculas);
   
        return [
            'pelicula' => $pelicula,
        ];
        
    }
}
/*
        $pelicula=$this->faker->randomElement($peliculas);
        $j = array_search($pelicula,$peliculas);
        unset($peliculas[$j]);

*/