// Obtener el contenedor de las películas y un contenedor para los asientos
const cartelera = document.querySelector('#peliculas');
const contenido = document.querySelector('#contenido');

// URL del endpoint para las películas
const Api_select = '/api/select_salas';

//cargar las peliculas al inicio
fetch(Api_select)
  .then((response) => {
    if (!response.ok) {
      throw new Error('Error en la API: ' + response.status);
    }
    return response.json();
  })
  .then((data) => {
    const peliculas = data['salas'];
    renderizarPeliculas(peliculas);
  })
  .catch((error) => {
    console.error('Error al obtener las películas:', error);
  });

// Función para renderizar las películas
function renderizarPeliculas(peliculas) {
  cartelera.innerHTML = '';

  peliculas.forEach((sala) => {
    const peliculaItem = document.createElement('button');
    peliculaItem.textContent = sala.pelicula;
    peliculaItem.dataset.id = sala.id;

    peliculaItem.innerHTML = `<img src="${sala.enlaceImg}" alt="${sala.pelicula}" class="rounded-md object-cover w-full h-48" crossorigin="anonymous">`;

    peliculaItem.addEventListener('click', () => {
      mostrarAsientos(sala.id);
    });

    cartelera.appendChild(peliculaItem);
  });
}

// Función para mostrar los asientos
function mostrarAsientos(idSala) {
  // Ocultar la cartelera de películas
  cartelera.style.display = '';

  // Mostrar el contenido de los asientos
  contenido.innerHTML = `<div class="flex justify-between items-center mb-4"><button id="atras" class="px-4 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-600">Atrás</button><h2 class="text-xl font-semibold">Asientos Disponibles en la sala ${idSala}</h2> </div>`;

  // Agregar evento al botón de "Atrás"
  const botonAtras = document.getElementById('atras');

  botonAtras.addEventListener('click', () => {

    volverAPeliculas();
  });

  fetch(`http://localhost:8080/public/api/select_sala_id/${idSala}`)

    .then((response) => {
      if (!response.ok) {
        throw new Error('Error al obtener los asientos: ' + response.status);
      }
      return response.json();
    })
    .then((data) => {
      const asientos = data.asientos;
      renderizarAsientosGrid(asientos);
    })
    .catch((error) => {
      console.error('Error al obtener los asientos: ' + error);
      contenido.innerHTML = 'Error al obtener los asientos. Inténtelo de nuevo más tarde';
    });
}

// Variable para almacenar los asientos seleccionados
let asientosSeleccionados = [];

// Función para pintar los asientos
function renderizarAsientosGrid(asientos) {
  const contenedorAsientos = document.createElement('div');
  contenedorAsientos.classList.add('grid', 'grid-cols-10', 'gap-2', 'w-full', 'max-w-xl', 'mx-auto', 'mb-6');

  asientos.forEach((asiento) => {
    const asientoDiv = document.createElement('div');
    asientoDiv.classList.add('flex', 'items-center', 'justify-center', 'h-12', 'w-12', 'cursor-pointer');

    if (asiento.reservado === 0) {
      asientoDiv.classList.add('bg-green-500', 'hover:bg-green-600');
      const img = document.createElement('img');
      img.src = 'asiento-libre.png';
      img.alt = 'Asiento libre';
      img.classList.add('h-full', 'w-full', 'object-contain');
      asientoDiv.appendChild(img);

      asientoDiv.addEventListener('click', () => {
        if (!asientosSeleccionados.includes(asiento.id)) {
          asientoDiv.classList.add('bg-orange-500');
          asientosSeleccionados.push(asiento.id);
        } else {
          asientoDiv.classList.remove('bg-orange-500');
          asientosSeleccionados = asientosSeleccionados.filter((id) => id !== asiento.id);
        }
      });

    } else {
      asientoDiv.classList.add('bg-gray-500', 'cursor-not-allowed');
      const img = document.createElement('img');
      img.src = 'asiento-ocupado.png';
      img.alt = 'Asiento ocupado';
      img.classList.add('h-full', 'w-full', 'object-contain');
      asientoDiv.appendChild(img);
    }

    contenedorAsientos.appendChild(asientoDiv);
  });

  contenido.appendChild(contenedorAsientos);

  // Crear y agregar el botón de "Reservar"
  const botonReservar = document.createElement('button');
  botonReservar.textContent = 'Reservar';
  botonReservar.classList.add('mt-6', 'px-4', 'py-2', 'bg-blue-500', 'text-white', 'rounded-md', 'hover:bg-blue-600');
  contenido.appendChild(botonReservar);

  // Evento para reservar los asientos seleccionados
  botonReservar.addEventListener('click', () => {
    if (asientosSeleccionados.length > 0) {
      reservarAsientos(asientosSeleccionados);
    } else {
      mostrarToast("Por favor, seleccione al menos un asiento.", 'error');
    }
  });
}
// Función para reservar los asientos
function reservarAsientos(asientosSeleccionados) {
    if (asientosSeleccionados.length === 0) {
        mostrarToast("Por favor, seleccione al menos un asiento.", 'error');
        return;
    }

    // Recorremos los asientos seleccionados
    asientosSeleccionados.forEach(idAsiento => {
        // Hacemos la solicitud GET sin headers, body ni método adicional
        fetch(`http://localhost:8080/public/api/reservar_asiento/${idAsiento}`)
            .then((response) => {
                if (!response.ok) {
                    throw new Error("No se pudo reservar el asiento.");
                }
                return response.json();
            })
            .then((data) => {
                if (data.message === 'Asiento actualizado con \u00e9xito') {
                    mostrarToast('Asiento reservado exitosamente', 'success');

                    // Cambiar el fondo del asiento a naranja para indicar que está reservado
                    const asientoDiv = document.querySelector(`#asiento-${idAsiento}`);
                    if (asientoDiv) {
                        asientoDiv.classList.add('bg-orange-500');
                    }
                } else {
                    mostrarToast('No ha sido posible reservar el asiento', 'error');
                }
            })
            .catch((error) => {
                console.error('Error al intentar reservar el asiento:', error);
                mostrarToast('Error al intentar reservar el asiento', 'error');
            });
    });
}
// Función para mostrar el toast
function mostrarToast(message, type) {
  const toast = document.createElement('div');
  toast.classList.add('fixed', 'bottom-5', 'left-1/2', 'transform', '-translate-x-1/2', 'px-6', 'py-3', 'rounded-lg', 'text-white', 'shadow-lg', 'w-72', 'text-center');
  if (type === 'success') {
    toast.classList.add('bg-green-500');
  } else if (type === 'error') {
    toast.classList.add('bg-red-500');
  }

  toast.textContent = message;
  document.body.appendChild(toast);

  // Eliminar el toast después de 3 segundos
  setTimeout(() => {
    toast.remove();
  }, 3000);
}

// Función para volver a la cartelera de películas
function volverAPeliculas() {
  // Mostrar la cartelera de películas
  cartelera.style.display = 'grid';

  // Limpiar los asientos
  contenido.innerHTML = '';

  // Llamar de nuevo a renderizar las películas
  fetch(Api_select)
    .then((response) => response.json())
    .then((data) => {
      renderizarPeliculas(data['salas']);
    })
    .catch((error) => {
      console.error('Error al obtener las películas:', error);
    });
}
