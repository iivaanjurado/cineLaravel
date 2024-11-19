const apiSelectSalas = 'http://127.0.0.1:8080/public/api/select_salas';
const apiUpdateSala = 'http://127.0.0.1:8080/public/api/update_sala'; // URL para actualizar sala

let movieId;
let peliculaSeleccionada = null; // Variable global para almacenar la película seleccionada

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
            console.log(data);
            const selectPeliculas = document.getElementById('movie');
            selectPeliculas.innerHTML = ''; // Limpiar el select antes de agregar nuevas opciones

            // Crear las opciones del select con las películas
            data.salas.forEach(sala => {
                const option = document.createElement('option');
                option.value = sala.id; // El ID de la película será el valor de la opción
                option.textContent = sala.pelicula; // El texto de la opción será el nombre de la película
                selectPeliculas.appendChild(option);
            });
        })
        .catch(error => {
            console.error('Error al cargar las películas:', error);
        });
}

// Función para cargar los detalles de la película seleccionada en el formulario
function cargarDetallesPelicula(event) {
    movieId = event.target.value; // Obtener el ID de la película seleccionada

    // Si no hay un ID seleccionado, no hacemos nada
    if (!movieId) {
        return;
    }

    // Buscar la película seleccionada en los datos obtenidos de la API (almacenados en `data.salas`)
    fetch(apiSelectSalas)
        .then(response => response.json())
        .then(data => {
            // Buscar la película seleccionada en la lista de salas
            peliculaSeleccionada = data.salas.find(sala => sala.id == movieId);

            if (peliculaSeleccionada) {
                // Asignar los valores de la película seleccionada a los inputs
                document.getElementById('titulo').value = peliculaSeleccionada.pelicula;
                document.getElementById('sinopsis').value = peliculaSeleccionada.sinopsis;
                document.getElementById('enlace').value = peliculaSeleccionada.enlaceImg;
            }
        })
        .catch(error => {
            console.error('Error al cargar los detalles de la película:', error);
        });
}

// Función para manejar la actualización de la sala
function actualizarSala(event) {
    event.preventDefault(); // Prevenir el comportamiento por defecto del formulario

    // Asegurarnos de que la película seleccionada no sea nula
    if (!peliculaSeleccionada) {
        alert('No se ha seleccionado ninguna película');
        return;
    }

    // Obtener los nuevos datos del formulario
    let titulo = document.getElementById('titulo').value;
    let sinopsis = document.getElementById('sinopsis').value;
    let enlace = document.getElementById('enlace').value;

    // Realizar una llamada al endpoint para actualizar la sala
    fetch(apiUpdateSala, {
        method: 'GET',
        body:{
            id: peliculaSeleccionada.id,
            titulo: titulo,
            sinopsis: sinopsis,
            enlace: enlace
        }

    })
        .then(response => {
            if (!response.ok) {
                throw new Error('Error al actualizar la sala: ' + response.status);
            }
            return response.json();
        })
        .then(data => {
            console.log(data);
            alert('Sala actualizada correctamente.');
            cargarPeliculas(); // Recargar las películas para reflejar los cambios
        })
        .catch(error => {
            console.error('Error al actualizar la sala:', error);
            alert('Hubo un problema al actualizar la sala.');
        });
}

// Llamar a la función para cargar las películas al cargar la página
window.onload = function () {
    cargarPeliculas();

    // Agregar un event listener al select para cargar los detalles de la película seleccionada
    const selectPeliculas = document.getElementById('movie');
    selectPeliculas.addEventListener('change', cargarDetallesPelicula);

    // Agregar un event listener al formulario para actualizar la sala
    const form = document.getElementById('formulario-sala');
    form.addEventListener('submit', actualizarSala);
};
