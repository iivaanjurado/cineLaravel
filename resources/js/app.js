//obtener los elementos del DOM
const cartelera = document.querySelector("#peliculas");
const contenido = document.querySelector("#contenido");

//EndPoints de la API
const Api_select = "/api/select_salas";
const apiSelectSala = "/api/select_sala_id/";
const apiReservarAsiento = "api/reservar_asiento/";

//llamada a la API
fetch(Api_select)
    .then((response) => {
        if (!response.ok) {
            throw new Error("Error en la API: " + response.status);
        }
        return response.json();
    })

    .then((data) => {
        //obtener los datos de las salas y almacenarlos
        const peliculas = data["salas"];

        //llamar a la funcion que va a pintar las peliculas
        renderizarPeliculas(peliculas);
    })
    .catch((error) => {
        console.error("Error al obtener las películas:", error);
    });

/*----------------FUNCION PARA PINTAR LAS PELICULAS--------------- */
function renderizarPeliculas(peliculas) {
    //limpiar el contenedor
    cartelera.innerHTML = "";

    //para cada pelicula se crea en un boton, en el se añade la imagen dentro para que se muestre en la web
    peliculas.forEach((sala) => {
        const peliculaItem = document.createElement("button");
        peliculaItem.textContent = sala.pelicula;
        peliculaItem.dataset.id = sala.id;

        //HTML con la informacion para pintar la imagen de la pelicula en el boton
        peliculaItem.innerHTML = `
        <div class="relative group">
          <img src="${sala.enlaceImg}" alt="${sala.pelicula}" class="rounded-md object-cover w-full h-auto transition duration-300 transform group-hover:grayscale group-hover:opacity-80" crossorigin="anonymous">

          <div class="absolute inset-0 flex items-center justify-center bg-black bg-opacity-50 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
            <span class="text-white text-lg font-bold p-4 bg-gray-800 rounded-md">Entradas</span>
          </div>
        </div>
      `;

        //evento para cuando se hace click en un boton
        peliculaItem.addEventListener("click", () => {
            //llamar a la funcion para mostrar los asientos de la sala que se pasa por parametro
            mostrarAsientos(sala.id);
        });

        //añadir el boton al container donde se encuentran todos los carteles
        cartelera.appendChild(peliculaItem);
    });
}

/*-----------------FUNCION PARA MOSTRAR LOS ASIENTOS DE CADA SALA---------------------- */
function mostrarAsientos(idSala) {
    //ocultar los carteles de las peliculas
    cartelera.style.display = "none";

    //pintar el boton de atrás y el titulo de la sala donde se encuentra
    contenido.innerHTML = `<div class="flex justify-between items-center mb-4"><button id="atras" class="px-4 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-600">Atrás</button><h2 class="text-xl font-semibold">Asientos Disponibles en la sala ${idSala}</h2> </div>`;

    //agregar el boton de atras
    const botonAtras = document.getElementById("atras");
    botonAtras.addEventListener("click", () => {
        //realizar la funcion para volver a peliculas
        volverAPeliculas();
    });

    //realizar la llamada a la API
    fetch(`${apiSelectSala}${idSala}`)
        .then((response) => {
            if (!response.ok) {
                throw new Error(
                    "Error al obtener los asientos: " + response.status
                );
            }
            return response.json();
        })

        //obtener los asientos de la API
        .then((data) => {
            const asientos = data.asientos;

            //llamar a la funcion para pintar los asientos
            renderizarAsientosGrid(asientos);
        })
        .catch((error) => {
            console.error("Error al obtener los asientos: " + error);
            contenido.innerHTML =
                "Error al obtener los asientos. Inténtelo de nuevo más tarde";
        });
}

//almacenar los asientos seleccionados
let asientosSeleccionados = [];

/*----------------------FUNCION PARA PINTAR LOS ASIENTOS----------------------- */
function renderizarAsientosGrid(asientos) {
    //crear el elemento donde se van a pintar los asientos
    const contenedorAsientos = document.createElement("div");
    contenedorAsientos.classList.add(
        "grid",
        "grid-cols-10",
        "gap-2",
        "w-full",
        "max-w-xl",
        "mx-auto",
        "mb-6"
    );

    //crear un div por cada asiento
    asientos.forEach((asiento) => {
        const asientoDiv = document.createElement("div");
        asientoDiv.classList.add(
            "flex",
            "items-center",
            "justify-center",
            "h-12",
            "w-12",
            "cursor-pointer"
        );

        //si el estado del asiento que viene de la API es un 0 significa que esta libre por lo que se aplican estilos para dicho estado
        if (asiento.reservado === 0) {
            asientoDiv.classList.add("bg-green-500", "hover:bg-green-600");
            const img = document.createElement("img");
            img.src = "asiento-libre.png";
            img.alt = "Asiento libre";
            img.classList.add("h-full", "w-full", "object-contain");
            asientoDiv.appendChild(img);

            //añadir evento para cuando se pulsa un asiento
            asientoDiv.addEventListener("click", () => {
                //si el asiento que se ha seleccionado no está dentro de los asientos seleccionados, añadirlo y aplicar estilos
                if (!asientosSeleccionados.includes(asiento.id)) {
                    asientoDiv.classList.add("bg-orange-500");
                    asientosSeleccionados.push(asiento.id);
                }
                //si esta incluido quitar el estilo
                else {
                    asientoDiv.classList.remove("bg-orange-500");
                    asientosSeleccionados = asientosSeleccionados.filter(
                        (id) => id !== asiento.id
                    );
                }
            });
        }
        //si está reservado aplicar estilos para los asientos con dicho estado
        else {
            asientoDiv.classList.add("bg-gray-500", "cursor-not-allowed");
            const img = document.createElement("img");
            img.src = "asiento-ocupado.png";
            img.alt = "Asiento ocupado";
            img.classList.add("h-full", "w-full", "object-contain");
            asientoDiv.appendChild(img);
        }

        contenedorAsientos.appendChild(asientoDiv);
    });

    contenido.appendChild(contenedorAsientos);

    //boton de reservar
    const botonReservar = document.createElement("button");
    botonReservar.textContent = "Reservar";
    botonReservar.classList.add(
        "mt-6",
        "px-4",
        "py-2",
        "bg-blue-500",
        "text-white",
        "rounded-md",
        "hover:bg-blue-600"
    );
    contenido.appendChild(botonReservar);

    //evento para cuando se hace click en el boton de reservar
    botonReservar.addEventListener("click", () => {
        //si hay 1 o mas asientos en el array llamar a la funcion para reservar los asientos
        if (asientosSeleccionados.length > 0) {
            reservarAsientos(asientosSeleccionados);
        }
        //si no mostrar un mensaje de error de que no se ha seleccionado ningun asiento
        else {
            mostrarToast("Por favor, seleccione al menos un asiento.", "error");
        }
    });
}

/*------------------------FUNCION PARA RESERVAR LOS ASIENTOS----------------------- */
function reservarAsientos(asientosSeleccionados) {
    //controlar que haya al menos 1 asiento seleccionado
    if (asientosSeleccionados.length === 0) {
        mostrarToast("Por favor, seleccione al menos un asiento.", "error");
        return;
    }

    //recorrer los asientos seleccionados
    asientosSeleccionados.forEach((idAsiento) => {
        // Hacemos la solicitud GET sin headers, body ni método adicional
        fetch(`${apiReservarAsiento}${idAsiento}`)
            .then((response) => {
                if (!response.ok) {
                    throw new Error("No se pudo reservar el asiento.");
                }
                return response.json();
            })

            .then((data) => {
                //si recibe el mensaje de asiento reservado desde la API
                if (data.message === "Asiento actualizado con \u00e9xito") {
                    mostrarToast("Asiento reservado exitosamente", "success");
                } else {
                    mostrarToast(
                        "No ha sido posible reservar el asiento",
                        "error"
                    );
                }
            })
            .catch((error) => {
                console.error("Error al intentar reservar el asiento:", error);
                mostrarToast("Error al intentar reservar el asiento", "error");
            });
    });
}
/*---------------------------FUNCION PARA MOSTRAR EL TOAST--------------------- */
function mostrarToast(message, type) {
    //crear el elemento
    const toast = document.createElement("div");
    toast.classList.add(
        "fixed",
        "bottom-5",
        "left-1/2",
        "transform",
        "-translate-x-1/2",
        "px-6",
        "py-3",
        "rounded-lg",
        "text-white",
        "shadow-lg",
        "w-72",
        "text-center"
    );

    //si el tipo es succes aplicar un estilo
    if (type === "success") {
        toast.classList.add("bg-green-500");
    }
    //si es de tipo error mostrar otro estilo
    else if (type === "error") {
        toast.classList.add("bg-red-500");
    }

    //mostrar el texto en el mensaje
    toast.textContent = message;
    document.body.appendChild(toast);

    //eliminar el toast despues de 3 segundos
    setTimeout(() => {
        toast.remove();
    }, 3000);
}

/*--------------------FUNCION PARA VOLVER A MOSTRAR LAS PELICULAS--------------- */
function volverAPeliculas() {
    //mostrar la cartelera de pelicula
    cartelera.style.display = "grid";

    //limpiar los asientos
    contenido.innerHTML = "";

    //hacer llamada a la API
    fetch(Api_select)
        .then((response) => response.json())
        .then((data) => {
            //volver a pintar las peliculas
            renderizarPeliculas(data["salas"]);
        })
        .catch((error) => {
            console.error("Error al obtener las películas:", error);
        });
}
