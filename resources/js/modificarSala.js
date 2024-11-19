// URL de la API para obtener las películas (salas)
const apiSelectSalas = 'http://127.0.0.1:8080/public/api/select_salas';

// Función para cargar las películas en el select
function cargarPeliculas() {
    fetch(apiSelectSalas)
        .then(response => {
            if (!response.ok) {
                throw new Error('Error al obtener las películas: ' + response.status);
            }
            return response.json();
        })
        .then(data => {
            const selectPeliculas = document.getElementById('movie');
            selectPeliculas.innerHTML = '';  // Limpiar el select antes de agregar nuevas opciones

            // Crear las opciones del select con las películas
            data.salas.forEach(sala => {
                const option = document.createElement('option');
                option.value = sala.id;  // El ID de la película será el valor de la opción
                option.textContent = sala.pelicula;  // El texto de la opción será el nombre de la película
                selectPeliculas.appendChild(option);
            });
        })
        .catch(error => {
            console.error('Error al cargar las películas:', error);
        });
}

// Función para cargar los detalles de la película seleccionada en el formulario
function cargarDetallesPelicula(event) {
    const movieId = event.target.value; // Obtener el ID de la película seleccionada

    // Si no hay un ID seleccionado, no hacemos nada
    if (!movieId) {
        return;
    }

    // Aquí buscamos la película seleccionada en los datos obtenidos de la API
    fetch(apiSelectSalas)
        .then(response => response.json())
        .then(data => {
            // Buscar la película seleccionada en la lista de salas
            const peliculaSeleccionada = data.salas.find(sala => sala.id == movieId);

            if (peliculaSeleccionada) {
                // Actualizar los campos del formulario con los datos de la película
                document.getElementById('titulo').value = peliculaSeleccionada.pelicula || ''; // Título de la película
                document.getElementById('sinopsis').value = peliculaSeleccionada.sinopsis || ''; // Sinopsis
                document.getElementById('enlace').value = peliculaSeleccionada.enlaceImg || ''; // URL de la imagen
            }
        })
        .catch(error => {
            console.error('Error al cargar los detalles de la película:', error);
        });
}

// Llamar a la función para cargar las películas al cargar la página
window.onload = function() {
    cargarPeliculas();

    // Agregar un event listener al select para cargar los detalles de la película seleccionada
    const selectPeliculas = document.getElementById('movie');
    selectPeliculas.addEventListener('change', cargarDetallesPelicula);
};
