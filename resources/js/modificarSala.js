
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

            //limpiar las opciones de las peliculas
            while (selectPeliculas.options.length > 1) {
                selectPeliculas.remove(1);
            }


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

        mostrarToast('Por favor seleccione una película.','error');
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
                mostrarToast('Detalles de la película cargados.', 'success');
            }
            else{

                mostrarToast('No se encontró información para la película seleccionada.', 'error');
            }
        })
        .catch(error => {
            console.error('Error al cargar los detalles de la película:', error);
            mostrarToast('Hubo un problema al cargar los detalles de la película.', 'error');
        });
}

/*----------------------------FUNCION ACTUALIZAR SALA----------------------------------------*/
// Función para manejar la actualización de la sala
function actualizarSala(event) {


    event.preventDefault();

    //comprobar que la pelicula seleccionada no sea nula
    if (!peliculaSeleccionada) {

        //mostrar un mensaje toast
        mostrarToast('No se ha seleccionado ninguna película','error');
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

    //llamada a la API para poder actualizar la sala
    fetch(apiUpdateSala, datos)
    .then(response => response.json())
    .then(data => {
        if (data.errors) {
            throw new Error('Error al actualizar la sala: ' + data.status);
        }

        console.log(data);
        mostrarToast('Sala actualizada correctamente.','success');

        //volver a cargar las peliculas y dejar los campos limpios
        cargarPeliculas();
    })
    .catch(error => {
        console.error('Error al actualizar la sala:', error);
        mostrarToast('Ha ocurrido un problema al actualizar la sala.','Error')
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
/*---------------------------FUNCION PARA MOSTRAR LOS MENSAJES TOAST---------------------- */
function mostrarToast(message, type) {

    //crear el cuerpo del mensaje Toast
    const toast = document.createElement('div');
    toast.classList.add('fixed', 'bottom-5', 'left-1/2', 'transform', '-translate-x-1/2', 'px-6', 'py-3', 'rounded-lg', 'text-white', 'shadow-lg', 'w-72', 'text-center');

    // Definir los colores de fondo según el tipo
    if (type === 'success') {
        toast.classList.add('bg-green-500');
    } else if (type === 'error') {
        toast.classList.add('bg-red-500');
    } else {
        toast.classList.add('bg-gray-500');
    }

    //añadir el texto al contenido del mensaje
    toast.textContent = message;

    //añadir el toast
    document.body.appendChild(toast);

    //eliminar el toast a los 3 segundos
    setTimeout(() => {
        toast.remove();
    }, 3000);
}

