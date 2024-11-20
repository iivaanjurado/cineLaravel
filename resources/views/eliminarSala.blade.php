<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Eliminar Sala</title>
    @vite(['resources/css/app.css','resources/js/eliminarSala.js'])
</head>
<body class="flex flex-col min-h-screen overflow-hidden">

    <div class="bg-gradient-to-l from-pink-400 to-blue-600 h-34 w-full flex items-center justify-between px-8">
        <div class="flex items-center">
            <a href="/cartelera"><img src="/logo.png" class="h-32 mr-4"></a>
        </div>
        <a href="/cartelera"><h1 class="text-6xl text-gray-100 font-mono italic mx-auto">FilmBox</h1></a>
        <div class="flex items-center space-x-2">
            <a href="/insertar-sala" class="bg-blue-500 text-white px-6 py-2 rounded-lg hover:bg-blue-600 transition-colors">Insertar Sala</a>
            <a href="/eliminar-sala" class="bg-blue-500 text-white px-6 py-2 rounded-lg hover:bg-blue-600 transition-colors">Eliminar Sala</a>
            <a href="/modificar-sala" class="bg-blue-500 text-white px-6 py-2 rounded-lg hover:bg-blue-600 transition-colors">Modificar Sala</a>
        </div>
    </div>

    <div class="flex-grow flex items-center justify-center bg-gray-100">
        <form action="" id="formulario-eliminar" class="bg-white shadow-md rounded-lg p-8 max-w-md w-full">
            <h2 class="text-2xl font-bold mb-6 text-center text-gray-800">Eliminar Sala</h2>
            <div class="mb-6">
                <label for="movie" class="block mb-2 text-sm font-medium text-gray-700">Selecciona una película</label>
                <select id="movie" name="movie" class="w-full px-3 py-2 text-gray-700 border rounded-lg focus:outline-none focus:border-blue-500">

                </select>
            </div>
            <button type="submit" class="w-full bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition-colors focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
                Eliminar sala
            </button>
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
