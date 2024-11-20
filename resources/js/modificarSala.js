
document.addEventListener('DOMContentLoaded',()=>{


const apiSelectSalas = 'http://127.0.0.1:8080/public/api/select_salas';
const apiUpdateSala = 'http://127.0.0.1:8080/public/api/update_sala'; // URL para actualizar sala


//variable donde se almacenará el id de la pelicula
let movieId;

//variable donde se va a guardar la pelicula seleccionada en el select
let peliculaSeleccionada = null;

/*----------------FUNCION PARA CARGAR LAS PELICULAS EN EL SELECT------------------ */
function cargarPeliculas() {

    //realizar la llamada a la API
    fetch(apiSelectSalas)

        .then(response => {
            if (!response.ok) {
                throw new Error('Error al obtener las películas: ' + response.status);
            }
            return response.json();
        })

        .then(data => {

            console.log(data);
            let selectPeliculas = document.querySelector('#movie');

            //limpiar el select
            selectPeliculas.remove(1);

            //foreach para crear las distintas opciones del select
            data.salas.forEach(sala => {
                const option = document.createElement('option');

                //id en el select, el mismo que en la base de datos
                option.value = sala.id;

                //valor el mismo titulo que hay en la base de datos
                option.textContent = sala.pelicula;
                selectPeliculas.appendChild(option);
            });
        })
        .catch(error => {
            console.error('Error al cargar las películas:', error);
        });
}

/*----------FUNCION PARA MOSTRAR LOS DETALLES DE LA PELICULA SELECCIONADA---------------- */
function cargarDetallesPelicula(event) {

    //obtener el id de la pelicula seleccionada en el select
    movieId = event.target.value;

    //si no se selecciona ninguna pelicula, no hacer nada
    if (!movieId) {
        return;
    }

    //llamada a la api para que se autorrellenen los campos de los inputs
    fetch(apiSelectSalas)

        .then(response => response.json())

        .then(data => {

            //buscar la pelicula seleccionada en la API
            peliculaSeleccionada = data.salas.find(sala => sala.id == movieId);

            if (peliculaSeleccionada) {

                //asignar los valores obtenidos de la pelicula seleccionada a los inputs
                document.getElementById('titulo').value = peliculaSeleccionada.pelicula;
                document.getElementById('sinopsis').value = peliculaSeleccionada.sinopsis;
                document.getElementById('enlace').value = peliculaSeleccionada.enlaceImg;
            }
        })
        .catch(error => {
            console.error('Error al cargar los detalles de la película:', error);
        });
}

/*----------------------------FUNCION ACTUALIZAR SALA----------------------------------------*/
// Función para manejar la actualización de la sala
function actualizarSala(event) {


    event.preventDefault();

    //comprobar que la pelicula seleccionada no sea nula
    if (!peliculaSeleccionada) {
        alert('No se ha seleccionado ninguna película');
        return;
    }

    //obtener los nuevos datos de la pelicula
    let titulo = document.getElementById('titulo').value;
    let sinopsis = document.getElementById('sinopsis').value;
    let enlace = document.getElementById('enlace').value;

    const datos = {
        method: 'POST',
        headers: {
            "Content-Type": "application/json",
          },
        body:JSON.stringify({
            id: peliculaSeleccionada.id,
            titulo: titulo,
            sinopsis: sinopsis,
            enlace: enlace
        })
    }

    console.log(datos)


    //llamada a la API para poder actualizar la sala
    fetch(apiUpdateSala, datos)
    .then(response => response.json())
    .then(data => {
        if (data.errors) {
            throw new Error('Error al actualizar la sala: ' + data.status);
        }
        console.log(data);
        alert('Sala actualizada correctamente.');

        //volver a cargar las peliculas y dejar los campos limpios
        cargarPeliculas();
    })
    .catch(error => {
        console.error('Error al actualizar la sala:', error);
        alert('Hubo un problema al actualizar la sala.');
    });
}

//llamar a la funcion para mostrar las peliculas en el select cuando se carga la pagina
window.onload = function () {
    cargarPeliculas();

    /*-------------------EVENTO PARA CARGAR LOS DETALLES DE LA PELICULA CUANDO SE SELECCIONA UNA NUEVA---------*/
    const selectPeliculas = document.getElementById('movie');

    selectPeliculas.addEventListener('change', cargarDetallesPelicula);

    /*OBTENER EL FORMULARIO Y CUANDO SE REALIZA UN SUBMIT LLAMAR AL METODO PARA QUE ACTUALICE LA SALA */
    const form = document.getElementById('formulario-sala');

    form.addEventListener('submit', actualizarSala);
};

})
