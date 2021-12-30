<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title') - Prístina Macramé</title>
    
    <!-- Tailwind CSS Link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.0.1/tailwind.min.css">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
  </head>
  <body class="bg-gray-100 text-gray-800 image-fondo-2">

    <nav class="flex py-5 bg-blue-400 text-white">
      <div class="w1/2 px-12 mr-auto">
        <p class="text-2xl font-bold text-white">Prístina Macramé</p>
      </div>

      <ul class="w-1/2 px-16 ml-auto flex justify-end pt-1">
        @if(auth()->check())

          <li>
            <p class="text-xl">Bienvenido <b>{{ auth()->user()->name }}</b></p>
          </li>
          <li>
            <a href="{{route('login.destroy')}}" class="font-bold py-2 px-4 rounded-md bg-red-500 hover:bg-red-600">Cerrar sesión</a>
          </li>

        @else
          <li class="mx-6">
            <a href="{{route('login.index')}}" class="font-semibold hover:bg-blue-700 py-3 px-4 rounded">Login</a>
          </li>
          <li>
            <a href="{{route('register.index')}}" class="font-semibold border-2 border-white py-2 px-4 rounded-md hover:bg-white hover:text-blue-700">Registrar</a>
          </li>
        @endif

      </ul>

      

    </nav>

    @yield('content')



  </body>
</html>