<!DOCTYPE html>
<html lang="es">
    <head>
        <!-- Etiquetas META -->

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="decription" content="Aplicación de gestión de motos Larabikes">

        <!--Título de la página -->
        <title>{{config('app.name')}} - PORTADA</title>

        <!--Carga del CSS de Bootstrap -->
        <link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap.min.css')}}">

    </head>
    <body class="container p-3">
        <!-- PARTE SUPERIROR (menú) -->
         <nav>
            <ul class="nav nav-pill my-3">
                <li class="nav-item mr-2">
                    <a class="nav-link active" href="{{url('/')}}">Inicio</a>
                </li>
                <li class="nav-item mr-2">
                    <a class="nav-link" href="{{route('bikes.index')}}">Garaje</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('bikes.create')}}">Nueva Moto</a>
                </li>
            </ul>
         </nav>

         <!-- PARTE CENTRAL -->
          <h1 class="my-2">Primer ejemplo con Laravel</h1>

          <main>
            <h2>Bienvenido a MartoBikes</h2>
            <p>Implementación de un <b>CRUD</b> de motos.</p>

            <figure class="row mt-2 mb-2 col-10 offset-1">
                <img class="d-block w-100"
                    alt = "Moto-motor de avión"
                    src="{{asset('images/bikes/bike0.jpg')}}">
            </figure>
          </main>

          <!-- PARTE INFERIOR -->
           <footer class="page-footer font-small p-4 bg-light">
                <p> Aplicación desarrollada por <b>Víctor Martorell.</b>
                    Utilizando <b>Laravel</b> y <b>Bootstrap</b>.</p>
                </p>
           </footer>
        </body>
</html>
