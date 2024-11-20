//endPoints de la API
const apiSelectSalas = '/api/select_salas';
const apiInsertSala = '/api/insert_sala';

// Asegúrate de que el DOM esté completamente cargado
document.addEventListener('DOMContentLoaded', function () {
    const form = document.querySelector('form');

    // Manejar el evento de envío del formulario
    form.addEventListener('submit', function (event) {
        event.preventDefault(); // Prevenir el comportamiento predeterminado de recargar la página

        // Obtener los valores de los campos del formulario
        const titulo = document.getElementById('titulo').value;
        const enlace = document.getElementById('enlace').value;
        const sinopsis = document.getElementById('sinopsis').value;

        // Validar que los campos no estén vacíos
        if (!titulo || !enlace || !sinopsis) {
            mostrarToast("Por favor, complete todos los campos.", 'error');
            return; // Detener la ejecución si falta algún campo
        }

        // Crear la URL con los parámetros de consulta (query parameters)
        const apiInsertSala = '/api/insert_sala';
        const url = `${apiInsertSala}?titulo=${encodeURIComponent(titulo)}&enlace=${encodeURIComponent(enlace)}&sinopsis=${encodeURIComponent(sinopsis)}`;

        // Realizar la solicitud GET usando fetch
        fetch(url, {
            method: 'GET',  // Usamos GET para enviar los datos como parámetros
        })
        .then(response => response.json())  // Convertir la respuesta a JSON
        .then(data => {
            // Comprobar si la respuesta de la API es exitosa
            if (data.success) {
                // Si la inserción fue exitosa, mostrar un mensaje y redirigir
                mostrarToast("Sala insertada exitosamente.", 'success');
                
                window.location.href = "/cartelera"; // Redirigir a la cartelera después de la inserción
            } else {
                // Si hay algún error, mostrar un mensaje
                mostrarToast("Error al insertar la sala: " + (data.message || "Inténtelo de nuevo más tarde"), 'error');
            }
        })
        .catch(error => {
            // En caso de un error en la solicitud, mostrar un mensaje
            console.error("Error en la solicitud:", error);
            mostrarToast("Hubo un problema al intentar insertar la sala.", 'error');
        });
    });
});
function mostrarToast(message, type) {
    // Crear el contenedor del toast
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

    // Añadir el mensaje al toast
    toast.textContent = message;

    // Añadir el toast al cuerpo del documento
    document.body.appendChild(toast);

    // Eliminar el toast después de 3 segundos
    setTimeout(() => {
        toast.remove();
    }, 3000);
}

