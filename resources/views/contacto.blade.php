@extends('layouts.master')
@section('titulo', 'Contactar con LaraBikes')
@section('contenido')
<div class="container row">
    <form class="col-7 my-2 border p-4"
    action="{{ route('contacto.email') }}" method="POST">

    {{csrf_field()}}

    <div class="form-group row">
        <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
        <input name="email" type="email" class="up form-control"
        id="inputEmail" placeholder="Email" maxlenght="255" required="required"
        value="{{old('email')}}"> 
    </div>
    <div class="form-group row">
        <label for="inputNombre" class="col-sm-2 col-form-label">Nombre</label>
        <input name="nombre" type="text" class="up form-control"
        id="inputNombre" placeholder="Nombre" maxlenght="255" required="required"
        value="{{old('nombre')}}">
    </div>
    <div class="form-group-row">
        <label for="inputAsunto" class="col-sm-2 col-form-label">Asunto</label>
        <input name="asunto" type="text" class="up form-control"
        id="inputAsunto" placeholder="Asunto" maxlenght="255" required="required"
        value="{{old('asunto')}}">
    </div>
    <div class="form-group row">
        <label for="inputMensaje" class="col-sm-2 col-form-label">Mensaje</label>
        <textarea name="mensaje" id="inputMensaje" class="up form-control"
        maxlength="2048" class="up front-control" required="required">{{old('mensaje')}}</textarea>
    </div>
    <div class="form-group row">
        <button type="submit" class="btn btn-succes m-2 mt-5">Enviar</button>
        <button type="reset" class="btn btn-secondary m-2 mt-5">Borrar</button>
    </div>
    </form>
    <iframe src="https://g.co/kgs/g5GanEr" style="min-width:300px; min-height: 300px" loading="lazy"
        class="col-5 my-2 border p-3"
        referrerpolicy="no-referrer-when-downgrade">
    </iframe>
</div>
@endsection

@section('enlaces')
        @parent
        <a href="{{route('bikes.index')}}" class="btn btn-primary m-2">Garaje</a>

@endsection