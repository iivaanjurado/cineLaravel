<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Asientos</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
    <style></style>
</head>
<body class="flex flex-col min-h-screen overflow-hidden">

    <div class="mx-64 my-20">
        <h2><b>Cine: </b>FilmBox</h2>
        <hr class="bg-gradient-to-l from-pink-400 to-blue-600 h-1 w-64 rounded-full">
        <br>
        <div class="flex items-center justify-start space-x-10"> 
            <div class="flex flex-col items-start">
                <h2><b>Pelicula: </b>Pelicula 3</h2>
                <hr class="bg-gradient-to-l from-pink-400 to-blue-600 h-1 w-48 rounded-full">
            </div>
            <div class="flex flex-col items-start">
                <h2><b>Sala: </b>Sala 4</h2>
                <hr class="bg-gradient-to-l from-pink-400 to-blue-600 h-1 w-48 rounded-full">
            </div>
            <div class="flex flex-col items-start">
                <h2><b>Hora: </b>19:45</h2>
                <hr class="bg-gradient-to-l from-pink-400 to-blue-600 h-1 w-48 rounded-full">
            </div>
        </div>
    </div>
    
    
       

    <div id="asientos" class="w-full flex-grow">

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