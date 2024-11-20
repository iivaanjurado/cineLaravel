document.addEventListener('DOMContentLoaded', () => {

    // Definir la URL de la API
    const apiSelectSalas = '/api/select_salas';    // Endpoint para obtener las salas
    const apiDeleteSala = '/api/delete_sala_id';   // Endpoint para eliminar una sala por ID

    let movieId = null;  // Variable para almacenar el ID de la película seleccionada

    // Función para cargar las películas en el select
    function cargarPeliculas() {
        fetch(apiSelectSalas)
            .then(response => response.json())
            .then(data => {
                let selectPeliculas = document.querySelector('#movie');
                selectPeliculas.innerHTML = '<option value="" disabled selected>Elige una película</option>';  // Limpiar select

                // Agregar las opciones al select
                data.salas.forEach(sala => {
                    const option = document.createElement('option');
                    option.value = sala.id;  // Usar el ID de la sala
                    option.textContent = sala.pelicula;  // Nombre de la película
                    selectPeliculas.appendChild(option);
                });
            })
            .catch(error => {
                console.error('Error al cargar las películas:', error);
            });
    }

    // Función para manejar la selección de una película en el select
    function seleccionarPelicula(event) {
        movieId = event.target.value;  // Obtener el ID de la película seleccionada
    }

    // Función para eliminar la sala seleccionada
    function eliminarSala() {
        if (!movieId) {
            alert('Por favor, selecciona una película para eliminar.');
            return;
        }

        // Confirmar la eliminación
        const confirmacion = confirm(`¿Estás seguro de que deseas eliminar la película con ID: ${movieId}?`);

        if (confirmacion) {
            // Realizar la solicitud GET para eliminar la película por ID
            fetch(apiDeleteSala + '/' + movieId)
                .then(response => response.json())
                .then(data => {
                    if (data.message) {
                        alert('Película eliminada correctamente.');
                        cargarPeliculas();  // Recargar las películas después de la eliminación
                    } else {
                        alert('Hubo un error al eliminar la película.');
                    }
                })
                .catch(error => {
                    console.error('Error al eliminar la película:', error);
                    alert('Hubo un problema al intentar eliminar la película.');
                });
        }
    }

    // Llamar a la función para cargar las películas cuando se carga la página
    cargarPeliculas();

    // Agregar el evento de cambio al select para manejar la selección de película
    const selectPeliculas = document.getElementById('movie');
    selectPeliculas.addEventListener('change', seleccionarPelicula);

    // Agregar el evento de submit al formulario para eliminar la película seleccionada
    const form = document.getElementById('formulario-eliminar');
    form.addEventListener('submit', (event) => {
        event.preventDefault();  // Prevenir el comportamiento predeterminado del formulario
        eliminarSala();  // Llamar a la función para eliminar la película
    });

});
