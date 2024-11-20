<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cine</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
</head>
<body class="flex flex-col min-h-screen bg-gray-100">

    <header class="bg-gradient-to-l from-pink-400 to-blue-600 py-4 w-full px-4 sm:px-8 mb-6">
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

    <div class="flex items-center justify-between w-full">
        <main class="flex-1 px-4 sm:px-8 py-6x">
            <div id="peliculas" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 overflow-y-auto">
            </div>
            <div id="contenido"></div>
        </main>
        <div id="info-pelicula" class="hidden w-1/4">
            <div id="detalle-pelicula"></div>
        </div>
    </div>
    
    





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
                <p>Términos y Condiciones</p>
                <p>Contacto</p>
                <p>Política y Privacidad</p>
            </div>

            <div class="text-black">
                <p>&copy; Cine Laravel 2024</p>
            </div>
        </div>
    </footer>

</body>
</html>
