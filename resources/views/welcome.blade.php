@php($pagina='portada')
@extends('layouts.master')
@section('titulo', 'Portada de MartoBikes')

@section('contenido')
            <figure class="row mt-2 mb-2 col-10 offset-1">
                <img class="d-block w-100"
                    alt = "Moto-motor de avión"
                    src="{{asset('images/bikes/bike0.jpg')}}">
            </figure>
@endsection

@section('enlaces') <!-- redifinicion de la zona de enlaces para que no aparezca -->
@endsection
