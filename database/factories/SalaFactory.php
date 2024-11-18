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
        'Frozen II',
        'Scary Movie',
        'Regreso al futuro',
        'Niños grandes'
    ];
    protected $enlaceImagenes = [
        'American Pie' => 'https://pics.filmaffinity.com/American_Pie-192121266-large.jpg',
        'Torrente: El brazo tonto de la ley' => 'https://pics.filmaffinity.com/Torrente_el_brazo_tonto_de_la_ley-769153589-large.jpg',
        'Garfield' => 'https://pics.filmaffinity.com/Garfield_La_pelaicula-129098716-large.jpg',
        'Interstellar' => 'https://pics.filmaffinity.com/Interstellar-832932589-large.jpg',
        'Frozen II' => 'https://pics.filmaffinity.com/Frozen_II-725228283-mmed.jpg',
        'Scary Movie' => 'https://pics.filmaffinity.com/Scary_Movie-943532513-large.jpg',
        'Regreso al futuro' => 'https://pics.filmaffinity.com/Scary_Movie-943532513-large.jpg',
        'Niños grandes' => 'https://pics.filmaffinity.com/Nianos_grandes-306284183-large.jpg'
    ];

    protected $sinopsisPeliculas = [
        'American Pie' => 'Un grupo de adolescentes hace un pacto para perder su virginidad antes de graduarse, enfrentándose a situaciones cómicas y complicadas en el proceso.',
        'Torrente: El brazo tonto de la ley' => 'Torrente, un excéntrico y torpe ex-policía, se ve envuelto en una serie de desventuras mientras intenta resolver un caso de corrupción.',
        'Garfield' => 'Garfield, un gato perezoso y glotón, debe lidiar con un nuevo perro en la casa, mientras busca maneras de seguir siendo el centro de atención.',
        'Interstellar' => 'En un futuro cercano, un grupo de astronautas viaja a través de un agujero de gusano en busca de un nuevo hogar para la humanidad, enfrentándose a misterios del espacio y el tiempo.',
        'Frozen II' => 'Dos hermanas, Elsa y Anna, enfrentan los desafíos de una magia congelante que separa a Elsa de su familia, mientras luchan por salvar su reino de la eterna nieve.',
        'Scary Movie' => 'Una parodia de películas de terror, donde un grupo de adolescentes se ve atrapado en situaciones absurdas y cómicas, mientras intentan sobrevivir a una serie de eventos extraños.',
        'Regreso al futuro' => 'Marty McFly, un joven que viaja al pasado con la ayuda de un DeLorean convertido en máquina del tiempo, debe asegurarse de que sus padres se enamoren para evitar que desaparezca de la historia.',
        'Niños grandes' => 'Un grupo de amigos de la infancia se reúne después de muchos años y redescubre la diversión y las lecciones de su juventud, mientras disfrutan de un verano lleno de travesuras.'
    ];

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        
        $pelicula = array_pop($this->peliculas);
        $sinopsis = $this->sinopsisPeliculas[$pelicula];
        $enlaceImg = $this->enlaceImagenes[$pelicula];
   
        return [
            'pelicula' => $pelicula,
            'enlaceImg'=> $enlaceImg,
            'sinopsis' => $sinopsis
        ];
        
    }
}
/*
        $pelicula=$this->faker->randomElement($peliculas);
        $j = array_search($pelicula,$peliculas);
        unset($peliculas[$j]);

*/