<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Eliminar Sala</title>
    @vite(['resources/css/app.css','resources/js/eliminarSala.js'])
</head>
<body class="flex flex-col min-h-screen overflow-x-hidden">

    <header class="bg-gradient-to-l from-pink-400 to-blue-600 py-4 w-full px-4 sm:px-8">
        <div class="flex flex-wrap items-center justify-between">
            <div class="w-full sm:w-auto mb-4 sm:mb-0 flex justify-center sm:justify-start">
                <a href="/cartelera"><img src="/logo.png" class="h-24 sm:h-32" alt="FilmBox Logo"></a>
            </div>
            <div class="w-full sm:w-auto mb-4 sm:mb-0 text-center">
                <a href="/cartelera">
                    <h1 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl text-gray-100 font-mono italic">FilmBox</h1>
                </a>
            </div>
            <nav class="w-full sm:w-auto flex flex-wrap justify-center sm:justify-end space-x-2 sm:space-x-4">
                <a href="/insertar-sala" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition-colors mb-2 sm:mb-0">Insertar Sala</a>
                <a href="/eliminar-sala" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition-colors mb-2 sm:mb-0">Eliminar Sala</a>
                <a href="/modificar-sala" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition-colors mb-2 sm:mb-0">Modificar Sala</a>
            </nav>
        </div>
    </header>

    <main class="flex-grow flex items-center justify-center bg-gray-100 px-4 py-6">
        <form action="" id="formulario-eliminar" class="bg-white shadow-md rounded-lg p-6 sm:p-8 max-w-md w-full m-4 sm:m-6">
            <h2 class="text-xl sm:text-2xl font-bold mb-6 text-center text-gray-800">Eliminar Sala</h2>
            <div class="mb-6">
                <label for="movie" class="block mb-2 text-sm font-medium text-gray-700">Selecciona una película</label>
                <select id="movie" name="movie" class="w-full px-3 py-2 text-gray-700 border rounded-lg focus:outline-none focus:border-blue-500" >
                </select>
            </div>
            <button type="submit" class="w-full bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition-colors focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
                Eliminar sala
            </button>
        </form>
    </main>

    <footer class="bg-gray-300 py-4 w-full">
        <div class="flex flex-col items-center justify-center text-center space-y-4">
            <div class="flex flex-wrap justify-center space-x-4 sm:space-x-6">
                <div class="bg-white p-2 rounded-full">
                    <img class="h-4 w-4" src="/instagram.png" alt="Instagram">
                </div>
                <div class="bg-white p-2 rounded-full">
                    <img class="h-4 w-4" src="/x.png" alt="X">
                </div>
                <div class="bg-white p-2 rounded-full">
                    <img class="h-4 w-4" src="/facebook.png" alt="Facebook">
                </div>
            </div>

            <hr class="w-1/4 border-gray-900">

            <div class="flex flex-wrap justify-center space-x-4 sm:space-x-6 text-black">
                <p>Terminos y Condiciones</p>
                <p>Contacto</p>
                <p>Politica y Privacidad</p>
            </div>

            <div class="text-black">
                <p>&copy;Cine Laravel 2024</p>
            </div>
        </div>
    </footer>

</body>
</html>
