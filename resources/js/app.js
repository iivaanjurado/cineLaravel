// Obtener el contenedor de las películas y un contenedor para los asientos
const cartelera = document.querySelector('#peliculas');
const contenido = document.querySelector('#contenido');

// URL del endpoint para las películas
const Api_select = 'http://127.0.0.1:8080/public/api/select_salas';

// Cargar las películas al inicio
fetch(Api_select)
  .then((response) => {
    if (!response.ok) {
      throw new Error('Error en la API: ' + response.status);
    }
    return response.json();
  })
  .then((data) => {
    const peliculas = data['salas'];

    if (Array.isArray(peliculas)) {
      renderizarPeliculas(peliculas);
    } else {
      console.error('La propiedad "salas" no es un array válido.');
    }
  })
  .catch((error) => {
    console.error('Error al obtener las películas:', error);
  });

// Renderizar la lista de películas
function renderizarPeliculas(peliculas) {
  cartelera.innerHTML = ''; // Limpiar el contenedor de películas

  peliculas.forEach((sala) => {
    const peliculaItem = document.createElement('button');
    peliculaItem.className = 'pelicula-item';
    peliculaItem.textContent = sala.pelicula;
    peliculaItem.dataset.id = sala.id; // Almacenar el ID de la película

    // Manejar el clic en la película
    peliculaItem.addEventListener('click', () => {
      cambiarVistaAsientos(sala.id, sala.pelicula);
    });

    cartelera.appendChild(peliculaItem);
  });
}

  // Hacer la solicitud para obtener los asientos desde la API
  fetch(`http://127.0.0.1:8080/public/api/asientos/${idSala}`)
    .then((response) => {
      if (!response.ok) {
        throw new Error('Error al obtener los asientos: ' + response.status);
      }
      return response.json();
    })
    .then((data) => {
      // Si los asientos se obtuvieron correctamente, renderizarlos
      const asientos = data.asientos; // Suponiendo que la API devuelve un array de asientos
      renderizarAsientos(asientos);
    })
    .catch((error) => {
      console.error('Error al obtener los asientos:', error);
      contenido.innerHTML += '<p>Error al cargar los asientos. Intenta de nuevo más tarde.</p>';
    });


// Renderizar la vista de los asientos
function renderizarAsientos(asientos) {
  contenido.innerHTML += '<div id="asientos"></div>';
  const contenedorAsientos = document.querySelector('#asientos');
  contenedorAsientos.innerHTML = '';

  asientos.forEach((fila, i) => {
    const filaDiv = document.createElement('div');
    filaDiv.className = 'fila-asientos';

    fila.forEach((asiento, j) => {
      const asientoDiv = document.createElement('div');
      asientoDiv.className = `asiento ${asiento.ocupado ? 'ocupado' : 'libre'}`;
      asientoDiv.textContent = asiento.ocupado ? 'X' : 'O';
      filaDiv.appendChild(asientoDiv);
    });

    contenedorAsientos.appendChild(filaDiv);
  });
}

// Manejar el evento de retroceso/avance del navegador
window.addEventListener('popstate', (event) => {
  if (event.state && event.state.id) {
    // Recuperar datos del historial
    cambiarVistaAsientos(event.state.id, `Película ID: ${event.state.id}`);
  } else {
    // Volver a la vista inicial (cartelera)
    contenido.innerHTML = '<h2>Selecciona una película</h2>';
  }
});
