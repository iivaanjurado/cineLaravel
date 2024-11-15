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

    <div class="bg-gradient-to-r from-red-300 to-red-600 h-32 w-full flex items-center justify-center">
      <h1 class="text-6xl text-gray-800">FilmBox</h1>
      <img src="{{ asset('logo.png') }}">
    </div>

    <div id="peliculas" class="w-full flex-grow">

    </div>

    <div>
        <h2>Insertar Sala</h2>
        <form action="">
            
        </form>
    </div>



    <footer class="bg-gray-800 text-white flex flex-col items-center justify-center text-center py-2 space-y-4">

      
        <div class="flex space-x-6">
            <div class="bg-white p-2 rounded-full">
                <img class="h-8 w-8"  src="{{ asset('instagram.png') }}" alt="Instagram">
            </div>
            <div class="bg-white p-2 rounded-full">
                <img class="h-8 w-8" src="/x.png" alt="X">
            </div>
            <div class="bg-white p-2 rounded-full">
                <img class="h-8 w-8" src="/facebook.png" alt="Facebook">
            </div>
        </div>
        
        <hr class="w-1/4 border-gray-400">

        <div  class="flex space-x-6">
            <p>Terminos y Condiciones</p>
            <p>Contacto</p>
            <p>Politica y Privacidad</p>
        </div>

        <div>
            <p>&copy;Cine Laravel 2024</p>
        </div>

    </footer>

</body>
</html>
