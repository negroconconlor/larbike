<!DOCTYPE html>
<html lang="es">
    <head>
        <!-- Etiquetas META -->

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="decription" content="Ejemplo CRUD mototototos Martobikes">
        <title>{{config('app.name') }} - @yield('titulo')</title> <!--mostrará el contenido de la sección "titulo", que se especificará en la vitsa hija -->


        <!-- CSS para Boostrap -->
         <link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap.min.css')}}">

    </head>

    <body class="cointainer p-3">
        <!-- PARTE SUPERIROR -->
        

        @section('navegacion')
        @php($pagina=$pagina ?? '')
         <nav>
            <ul class="nav nav-pills my-3">
                <li class="nav-item mr-2">
                    <a class="nav-link {{$pagina=='portada'? 'active':''}}" 
                    href="{{ route('portada') }}">Home</a>
                </li>
                <li class="nav-item mr-2">
                    <a class="nav-link {{$pagina == 'listamotos'? 'active' : ''}}" 
                    href="{{route('bikes.index')}}">Garaje</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{$pagina == 'nuevamoto'? 'active':''}}" 
                    href="{{route('bikes.create')}}">Nueva Moto</a>
                </li>
                <li class="nav-item mr-2">
                    <a class="nav-link {{$pagina == 'contacto'? 'active' : ''}}"
                    href="{{route('contacto')}}">Contacto</a>
                </li>
            </ul>
         </nav>
        @show <!-- se mostrará en las vistas hijas a no ser que estas la redefinan (definiendo una sección con el mismo nombre) -->
    </body>

    <!-- PARTE CENTRAL -->
     <x>
        <h2>@yield('titulo')</h2> <!--mostrará el "titulo" especificado en la vista hija-->

        @if(Session::has('success')) <!--inclusión condicionada de sub-vistas-->
        <x-alert type="success" message="{{Session::get('success')}}"/>
        @endif

        @if($errors->any())
        <x-alert type="danger" message="Se han producido errores:">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>   
        </x-alert>
        @endif
                   
        <p>Contamos con un catálogo de {{ $total }} motos. </p>
        @yield('contenido') <!--mostrará la sección "contenido" de la vista hija-->

     <!-- PARTE INFERIOR -->
      @section('pie')
        <footer class="page-form font-small p-4 bg-light">
            <p>Aplicación creada por {{$autor}} como ejemplo de classe. 
                Dessarollada haciendo uso de <b>Laravel</b> y <b>Bootstrap</b>.
            </p>
        </footer>
        @show
     
</html>