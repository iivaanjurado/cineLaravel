//EndPoints de la API
const apiSelectSalas = '/api/select_salas';
const apiInsertSala = '/api/insert_sala';

//evento para asegurar que han cargado los elementos del DOM
document.addEventListener('DOMContentLoaded', function () {
    const form = document.querySelector('form');

    //evento para controlar cuando se pulsa el boton del formulario
    form.addEventListener('submit', function (event) {

        //prevenir que recargue la pagina
        event.preventDefault();

        //obtener los valores del formulario que se van a actualizar
        const titulo = document.getElementById('titulo').value;
        const enlace = document.getElementById('enlace').value;
        const sinopsis = document.getElementById('sinopsis').value;

        //comprobar que los campos no estan vacios
        if (!titulo || !enlace || !sinopsis) {

            mostrarToast("Por favor, complete todos los campos.", 'error');

            return;
        }

        //realizar el enlace para enviar los datos mediante GET
        const url = `${apiInsertSala}?titulo=${encodeURIComponent(titulo)}&enlace=${encodeURIComponent(enlace)}&sinopsis=${encodeURIComponent(sinopsis)}`;

        //llamada a la API mediante GET
        fetch(url, {
            method: 'GET',
        })
        .then(response => response.json())

        .then(data => {

            //si se ha realizado correctamente, mostrar un mensaje
            if (data.success) {

                mostrarToast("Sala insertada exitosamente.", 'success');

            } else {

                mostrarToast("Error al insertar la sala: " + (data.message || "Inténtelo de nuevo más tarde"), 'error');
            }
        })
        .catch(error => {

            console.error("Error en la solicitud:", error);
            mostrarToast("Hubo un problema al intentar insertar la sala.", 'error');
        });
    });
});

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

