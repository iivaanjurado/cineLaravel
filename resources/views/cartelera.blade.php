<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cine</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
</head>
<body class="flex flex-col min-h-screen overflow-hidden">

    <div class="bg-gradient-to-l from-pink-400 to-blue-600 h-34 w-full flex items-center justify-between px-8">
        <div class="flex items-center">
            <img src="/logo.png" class="h-32 mr-4">
        </div>
        <h1 class="text-6xl text-gray-100 font-mono italic mx-auto">FilmBox</h1>
        <div class="flex items-center space-x-2">
            <a href="/cartelera" class="bg-blue-500 text-white px-6 py-2 rounded-lg hover:bg-blue-600 transition-colors">Cartelera</a>
            <a href="/insertar-sala" class="bg-blue-500 text-white px-6 py-2 rounded-lg hover:bg-blue-600 transition-colors">Insertar Sala</a>
            <a href="/eliminar-sala" class="bg-blue-500 text-white px-6 py-2 rounded-lg hover:bg-blue-600 transition-colors">Elimiar Sala</a>
        </div>
    </div>


    <div id="peliculas" class="w-full flex-grow">

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
