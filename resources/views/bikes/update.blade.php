@extends('layouts.master') <!-- hereda del layout "master"-->
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
          <h1 class="my-2">Gestor de motos MartoBikes</h1>
          <main>
            <h2>Actualización de la moto {{"$bike->marca $bike->modelo"}}</h2>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li> 
                        @endforeach
                    </ul>
                </div>
            @endif

            @if (Session::has('success'))
                <div class="alert alert-success">
                    {{ Session::get('success') }}
                </div>
            @endif
            <form class="my-2 border p-5" method="POST" action="{{route('bikes.update', $bike->id)}}" enctype="multipart/form-data">
                {{ csrf_field() }}
                <input name="_method" type="hidden" value="PUT">

                <div class="form-group row">
                    <label for="inputMarca" class="col-sm-2 col-form-label">Marca</label>
                    <input name="marca" value="{{$bike->marca}}" type="text" class="up form-control col-sm-10" id="inputMarca" placeholder="Marca" maxlength="255" required="required">
                </div>

                <div class="form-group row">
                    <label for="inputModelo" class="col-sm-2 col-form-label">Modelo</label>
                    <input name="modelo" value="{{$bike->modelo}}" type="text" class="up form-control col-sm-10" id="inputModelo" placeholder="Modelo" maxlength="255" required="required">
                </div>

                <div class="form-group row">
                    <label for="inputprecio" class="col-sm-2 col-form-label">Precio</label>
                    <input name="precio" value="{{$bike->precio}}" type="number" class="form-control col-sm-4" id="inputprecio" min="0" step="0.01" required="required">
                </div>
                
                <div class="form-group row">
                    <label for="inputkms" class="col-sm-2 col-form-label">Kms</label>
                    <input name="kms" value="{{$bike->kms}}" type="number" class="form-control col-sm-4" id="inputkms" required="required">
                </div>

                <div class="form-group row">
                    <div class="form-check">
                        <input name="matriculada" value="1" class="form-check-input" type="checkbox" {{$bike->matriculada ? "checked" : ""}}>
                        <label class="form-check-label">Matriculada</label>
                    </div>
                </div>
                <div class="text-end my-3">
                <div class="btn-group mx-2">
                        <a class="mx-2" href="{{route('bikes.show', $bike->id)}}">
                        <img height="40" width="40" src="{{asset('images/buttons/show.png')}}" alt="Detalles" title="Detalles">
                        </a>
                        <a class="mx-2" href="{{route('bikes.delete', $bike->id)}}">
                        <img height="40" width="40" src="{{asset('images/buttons/delete.png')}}" alt="Borrar" title="Borrar">
                        </a>
                </div>
            </div>
            
            <div class="form-group row my-3">
                <div class="col-sm-9">
                    <label for="inputImagen" class="col-sm-2 col-form-label">
                        {{$bike->imagen? 'Sustituir' : 'Añadir'}} imagen
                    </label>
                    <input name="imagen" type="file" class="form-control-file" id="inputImagen">

                    @if($bike->imagen)
                    <div class="form-check my-3">
                        <input name="eliminarimagen" type="checkbox"
                               class="form-check-input" id="inputEliminar">
                        <label for="inputEliminar" class=" form-check-label">Eliminar imagen</label>       
                    </div>
                    <script>
                        inputEliminar.onchage = function(){
                            inputImagen.disabled = this.checked;
                        }
                    </script>
                    @endif
                <div class="col-sm-3">
                    <label>Imagen atual:</label>
                    <img class="rounded img-thumbnail my-3" style="max-width: 400px"
                            alt="Imagen de {{$bike->marca}} {{$bike->modelo}}"
                            title="Imagen de {{$bike->marca}} {{$bike->modelo}}"
                            src="{{
                                $bike->imagen ?
                                asset('storage/'.config('filesystems.bikesImageDir')).'/'.$bike->imagen :
                                asset('storage/'.config('filesystems.bikesImageDir')).'/default.png'
                            }}">
                </div>
            </div>
                <div class="form-group row">
                    <button type="submit" class="btn btn-success mt-5 m-2">Guardar</button>
                    <button type="reset" class="btn btn-secondary m-2">Reestablecer</button>
                </div>
                
            </form>
          

            <div class="btn-group" role="group" aria-label="Links">
                <a href="{{url('/')}}" class="btn btn-primary m-2">Inicio</a>
                <a href="{{route('bikes.index')}}" class="btn btn-primary m-2">Garaje</a>
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
