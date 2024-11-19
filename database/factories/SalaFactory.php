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
        'Interestelar',
        'Frozen II',
        'Scary Movie',
        'Regreso al futuro',
        'Niños grandes'
    ];
    protected $enlaceImagenes = [
        'American Pie' => 'https://m.media-amazon.com/images/I/712WOyd68vL._AC_UF894,1000_QL80_.jpg',
        'Torrente: El brazo tonto de la ley' => 'https://m.media-amazon.com/images/I/71-NlxgRwJL._AC_UF350,350_QL50_.jpg',
        'Garfield' => 'https://m.media-amazon.com/images/S/pv-target-images/edb2d4c89ce249d2ba68c7ecfcf482e1ae9bff689c9d4071e6cc8666b02b51de.jpg',
        'Interestelar' => 'https://m.media-amazon.com/images/I/712I5GOGprL._AC_UF894,1000_QL80_.jpg',
        'Frozen II' => 'https://m.media-amazon.com/images/I/81zhbnH3XSL._AC_UF894,1000_QL80_.jpg',
        'Scary Movie' => 'https://m.media-amazon.com/images/I/514YxCy-U5L._AC_UF894,1000_QL80_.jpg',
        'Regreso al futuro' => 'https://m.media-amazon.com/images/I/61ZEcXTypgS._AC_UF894,1000_QL80_.jpg',
        'Niños grandes' => 'https://m.media-amazon.com/images/I/51nmZn97-+L.jpg'
    ];
    protected $sinopsisPeliculas = [
        'American Pie' => 'Un grupo de adolescentes hace un pacto para perder su virginidad antes de graduarse, enfrentándose a situaciones cómicas y complicadas en el proceso.',
        'Torrente: El brazo tonto de la ley' => 'Torrente, un excéntrico y torpe ex-policía, se ve envuelto en una serie de desventuras mientras intenta resolver un caso de corrupción.',
        'Garfield' => 'Garfield, un gato perezoso y glotón, debe lidiar con un nuevo perro en la casa, mientras busca maneras de seguir siendo el centro de atención.',
        'Interestelar' => 'En un futuro cercano, un grupo de astronautas viaja a través de un agujero de gusano en busca de un nuevo hogar para la humanidad, enfrentándose a misterios del espacio y el tiempo.',
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