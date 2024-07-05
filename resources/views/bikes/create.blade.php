@php($pagina="nuevamoto")
@extends('layouts.master') <!-- hereda del layout "master"-->
@section('titulo', '¡Nueva moto!') <!-- Aparecerá "Nueva moto" allí donde tengamos yield('titulo') en el master -->

@section('contenido') 
<!-- definición de la sección "contenido" (hasta el endsection) -->
            <form class="my-2 border p-5" method="POST" action="{{route('bikes.store')}}" enctype="multipart/form-data">
                {{csrf_field()}} <!--Con esto evitamos ataques de errores de session, que no se mantega la session capturando el id del usuario-->
                <div class="form-group row">
                    <label for="inputMarca" class="col-sm-2 col-form-label">Marca</label>
                    <input name="marca" type="text" class="up form-control col-sm-10"
                    id="inputMarca" placeholder="Marca" maxlength="255" required="required"
                    value="{{old('marca')}}">
                </div>
                <div class="form-group row">
                    <label for="inputModelo" class="col-sm-2 col-form-Label">Modelo</label>
                    <input name="modelo" type="text" class="up form-control col-sm-10" id="inputModelo" placeholder="Modelo" maxlength="255" required="required" value="{{old('modelo')}}">
                </div>

                <div class="form-group row">
                    <label for="inputkms" class="col-sm-2 col-form-Label">Kms</label>
                    <input name="kms" type="number" class="form-control col-sm-4" id="inputkms" required="required" value="{{old('kms')}}">
                </div>

                <div class="form-group row">
                    <label for="inputPrecio" class="col-sm-2 col-form-Label">Precio</label>
                    <input name="precio" type="number" class="up form-control col-sm-4" id="inputPrecio" maxlength="11" required="required" min="0" step="0.01" value="{{old('precio')}}">
                </div>
                <div class="form-group row">
                    <div class="form-check">
                        <input name="matriculada" value="1" class="form-check-input" type="checkbox" {{empty(old('matriculada')) ? "" : "checked"}}>
                        <label class="form-check-label">Matriculada</label>
                    </div>
                </div>
                <div class="form-group row">
                    <button type="submit" class="btn btn-success m-2 mt-5">Guardar</button>
                    <button type="reset" class="btn btn-secondary m-2">Borrar</button>
                </div>
                <div class="form-group row">
                    <label for="inputImagen" class="col-sm-2 col-form-label">Imagen</label>
                    <input name="imagen" type="file" class="form-control-file col-sm-10" id="inputImagen">
                </div>
                </form> 
@endsection 
<!--fin de la seccion contenido -->

@section('enlaces')
        @parent
        <a href="{{route('bikes.index')}}" class="btn btn-primary m-2">Garaje</a>
@endsection
                
               