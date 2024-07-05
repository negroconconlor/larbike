@extends('layouts.master') <!-- hereda del layout "master"-->
@php($pagina="listamotos")
@section('titulo', 'Listado de motototottotos!')
@section('contenido')
            @if(Session::has('success'))
                <div class="alert alert-success">
                    {{Session::get('success')}}
                </div>
            @endif
            <div class="row">
                <div class="col-6 text-start"> {{ $bikes->links() }}</div>
                <div class="col-6 text-end"> 
                    <p>Nueva Moto <a href="{{route('bikes.create')}}" class="btn btn-success">+</a></p>
                </div>
            </div>

            <table class="table table-striped table-bordered">
           
                <tr>
                    <th>ID</th>
                    <th>Imagen</th>
                    <th>Marca</th>
                    <th>Modelo</th>
                    <th>Operaciones</th>
                </tr>
                
                @foreach($bikes as $bike)
                <tr>
                    <td>{{$bike->id}}</td>
                    <td class="text-center" style="max-width: 80px">
                        <img class="rounded" style="max-width: 80%"
                        alt="Imagen de {{$bike->marca}} {{$bike->modelo}}"
                        title="Imagen de {{$bike->marca}} {{$bike->modelo}}"
                        src="{{
                        $bike->imagen?
                        asset('storage/'.config('filesystems.bikesImageDir')).'/'.$bike->imagen:
                        asset('storage/'.config('filesystems.bikesImageDir')).'/default.png'
                        }}">
                    </td>
                    <td>{{$bike->marca}}</td>
                    <td>{{$bike->modelo}}</td>
                    <td class="text-center">
                        <a href="{{route('bikes.show', $bike->id)}}"><img height="20" width="20" src="{{asset('images/buttons/show.png')}}" alt="Ver detalles" title="Ver detalles"></a>
                       
                        <a href="{{route('bikes.edit', $bike->id)}}">
                            <img height="20" width="20" src="{{asset('images/buttons/update.png')}}" alt="Modificar" title="Modificar"></a>
                        
                        <a href="{{route('bikes.delete', $bike->id)}}">
                            <img height="20" width="20" src="{{asset('images/buttons/delete.png')}}" alt="Borrar" title="Borrar"></a>
                        
                    </td>
                </tr>
                @endforeach
                <tr><td colspan="4">Mostrando {{sizeof($bikes)}} de {{$total}}.</td></tr>
                </table>
@endsection
