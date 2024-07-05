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
        <h1 class="my-2">Gestor de motos Larabikes</h1>
        <main>
            <h2>Borrado de la moto {{"$bike->marca $bike->modelo"}}</h2>
            <form method="POST" class="my-2 border p-5" action="{{route('bikes.destroy', $bike->id)}}">
                {{ csrf_field() }}
                <input name="_method" type="hidden" value="DELETE">
                <label for="confirmdelete">Confirmar el borrado de {{"$bike->marca $bike->modelo"}}:</label>
                <input type="submit" alt="Borrar" title="Borrar" class="btn btn-danger m-4" value="Borrar" id="confirmdelete">
            </form>

            <div class="btn-group" role="group" aria-label="Links">
                <a href="{{url('/')}}" class="btn btn-primary m-2">Inicio</a>
                <a href="{{route('bikes.index')}}" class="btn btn-primary m-2">Garaje</a>
                <a href="{{route('bikes.show', $bike->id)}}" class="btn btn-primary m-2">Regresar a detalles de la moto</a>
            </div>
        </main>


          <!-- PARTE INFERIOR -->
           <footer class="page-footer font-small p-4 bg-light">
                <p> Aplicación desarrollada por Víctor Martorell.
                    Desarrollada utilizando uso de <b>Laravel</b> y <b>Bootstrap</b>.</p>
                </p>
           </footer>
        </body>
</html>
