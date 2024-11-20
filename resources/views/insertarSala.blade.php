<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Insertar Sala</title>
    @vite(['resources/css/app.css','resources/js/insertarSala.js'])
</head>
<body class="flex flex-col min-h-screen overflow-hidden">

    <div class="bg-gradient-to-l from-pink-400 to-blue-600 h-34 w-full flex items-center px-8 mb-6  ">
        <div class="flex-1 flex items-center">
            <a href="/cartelera"><img src="/logo.png" class="h-32" alt="FilmBox Logo"></a>
        </div>
        <div class="flex-1 flex justify-center items-center">
            <a href="/cartelera">
                <h1 class="text-6xl text-gray-100 font-mono italic">FilmBox</h1>
            </a>
        </div>
        <div class="flex-1 flex items-center justify-end space-x-2">
            <a href="/insertar-sala" class="bg-blue-500 text-white px-6 py-2 rounded-lg hover:bg-blue-600 transition-colors">Insertar Sala</a>
            <a href="/eliminar-sala" class="bg-blue-500 text-white px-6 py-2 rounded-lg hover:bg-blue-600 transition-colors">Eliminar Sala</a>
            <a href="/modificar-sala" class="bg-blue-500 text-white px-6 py-2 rounded-lg hover:bg-blue-600 transition-colors">Modificar Sala</a>
        </div>
    </div>

    <div class="flex-grow flex items-center justify-center bg-gray-100">
        <form id="formulario" class="max-w-4xl mx-auto p-8 bg-white rounded-lg shadow-lg mt-10">
            <h2 class="text-3xl font-semibold text-center mb-8">Agregar Sala</h2>

            <div class="mb-6">
                <label for="titulo" class="block text-lg font-medium text-gray-700">Título</label>
                <input type="text" id="titulo" class="mt-1 p-3 w-full border border-gray-300 rounded-md text-lg" placeholder="Título de la película">
            </div>

            <div class="mb-6">
                <label for="enlace" class="block text-lg font-medium text-gray-700">Enlace de la imagen</label>
                <input type="url" id="enlace" class="mt-1 p-3 w-full border border-gray-300 rounded-md text-lg" placeholder="URL de la imagen">
            </div>

            <div class="mb-6">
                <label for="sinopsis" class="block text-lg font-medium text-gray-700">Sinopsis</label>
                <textarea id="sinopsis" class="mt-1 p-3 w-full border border-gray-300 rounded-md text-lg" rows="6" placeholder="Descripción de la película"></textarea>
            </div>

            <div class="flex justify-center mt-8">
                <button type="submit" class="px-8 py-4 bg-blue-500 text-white rounded-md hover:bg-blue-600 text-xl">Agregar Sala</button>
            </div>
        </form>



    </div>

    <footer class="bg-gray-300 flex flex-col items-center justify-center text-center py-2 space-y-4">
        <div class="flex space-x-6">
            <div class="bg-white p-2 rounded-full">
                <img class="h-4 w-4"  src="/instagram.png" alt="Instagram">
            </div>
            <div class="bg-white p-2 rounded-full">
                <img class="h-4 w-4" src="/x.png" alt="X">
            </div>
            <div class="bg-white p-2 rounded-full">
                <img class="h-4 w-4" src="/facebook.png" alt="Facebook">
            </div>
        </div>

        <hr class="w-1/4 border-gray-900">

        <div  class="flex space-x-6 text-black">
            <p>Terminos y Condiciones</p>
            <p>Contacto</p>
            <p>Politica y Privacidad</p>
        </div>

        <div class="text-black">
            <p>&copy;Cine Laravel 2024</p>
        </div>
    </footer>

</body>
</html>
