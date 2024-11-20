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
            alert("Por favor, complete todos los campos.");
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
                alert("Sala insertada exitosamente.");
                window.location.href = "/cartelera"; // Redirigir a la cartelera después de la inserción
            } else {
                // Si hay algún error, mostrar un mensaje
                alert("Error al insertar la sala: " + (data.message || "Inténtelo de nuevo más tarde"));
            }
        })
        .catch(error => {
            // En caso de un error en la solicitud, mostrar un mensaje
            console.error("Error en la solicitud:", error);
            alert("Hubo un problema al intentar insertar la sala.");
        });
    });
});
