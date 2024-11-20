document.addEventListener("DOMContentLoaded", () => {

    //EndPoints de la API
    const apiSelectSalas = "/api/select_salas";
    const apiDeleteSala = "/api/delete_sala_id";

    //almacenar el id de la pelicula seleccionada
    let movieId = null;

/*-----------------------------FUNCION PARA CARGAR LAS PELICULAS EN EL SELECT------------------- */
    function cargarPeliculas() {

        //realizar la llamada a la API
        fetch(apiSelectSalas)
        ç
            .then((response) => response.json())

            .then((data) => {

                //obtener el select del DOM
                let selectPeliculas = document.querySelector("#movie");

                //limpiar el Select
                selectPeliculas.innerHTML =
                    '<option value="" disabled selected>Elige una película</option>';

                //agregar las peliculas que se obtienen mediante la llamada a la API como opcion al select
                data.salas.forEach((sala) => {
                    const option = document.createElement("option");

                    //valor será el id de la pelicula
                    option.value = sala.id;

                    //el contenido será el titulo de la pelicula
                    option.textContent = sala.pelicula;
                    selectPeliculas.appendChild(option);
                });
            })
            .catch((error) => {
                console.error("Error al cargar las películas:", error);
            });
    }

/*-------------------FUNCION PARA MANEJAR CUANDO SE SELECCIONA UNA PELICULA------------- */
    function seleccionarPelicula(event) {

        //obtener el id de la pelicula seleccionada
        movieId = event.target.value;
    }

/*-----------------------FUNCION PARA ELIMINAR UNA SALA--------------- */
    function eliminarSala() {

        //si no se ha elegido ninguna pelicula mostrar un mensaje de error
        if (!movieId) {
            alert("Por favor, selecciona una película para eliminar.");
            return;
        }

        //mensaje para confirmar la pelicula que se va a borrar
        const confirmacion = confirm(
            `¿Estás seguro de que deseas eliminar la película con ID: ${movieId}?`
        );

        //si la confirmacion es true eliminar la pelicula
        if (confirmacion) {

            //llamada a la API
            fetch(apiDeleteSala + "/" + movieId)

                .then((response) => response.json())
                .then((data) => {

                    if (data.message) {

                        //mensaje para mostrar que se ha eliminado la pelicula
                        alert("Película eliminada correctamente.");

                        //recargar la lista de peliculas
                        cargarPeliculas();
                    }
                    else {
                        alert("Hubo un error al eliminar la película.");
                    }
                })
                .catch((error) => {
                    console.error("Error al eliminar la película:", error);
                    alert("Hubo un problema al intentar eliminar la película.");
                });
        }
    }

    //cuando se carga la pagina llamar al metodo para cargar las peliculas
    cargarPeliculas();

    //evento para manejar cuando se selecciona una pelicula
    const selectPeliculas = document.getElementById("movie");
    selectPeliculas.addEventListener("change", seleccionarPelicula);

    //agregar el evento para cuando se pulsa el boton del formulario
    const form = document.getElementById("formulario-eliminar");
    form.addEventListener("submit", (event) => {

        //prevenir que no recargue la pagina
        event.preventDefault();

        //eliminar la sala
        eliminarSala();
    });
});
