//import './bootstrap';

//obtener los elementos de las vistas
const cartelera = document.querySelector('#peliculas');

// URL del endpoint de la API
const Api_select = 'http://127.0.0.1:8080/public/api/select_salas';

fetch(Api_select)
    .then(response => {
        // Validar que la respuesta sea exitosa
        if (!response.ok) {
            throw new Error('Error en la API: ' + response.status);
        }
        // Convertir la respuesta a JSON
        return response.json();
    })
    .then(data => {
        // Acceder al array "salas"
        const salas = data['salas'];

        salas.forEach(sala => {

            const peliculaCartel = document.createElement('div');
            peliculaCartel.innerHTML = sala.pelicula;
            cartelera.appendChild(peliculaCartel)
        });

    })
    .catch(error => {
        console.error('Error al obtener las películas:', error);
    });
