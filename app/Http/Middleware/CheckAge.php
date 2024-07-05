<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;


class CheckAge
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, int $minimo = 99){

        $response=$next($request);

        //debug: verificar valores de entrada
        //dd($request->query('edad'), $minimo);

        //miramos si el usuarios es menor de edad
        if($request->query('edad')<$minimo){
            abort(403, 'Acceso denegado, debes ser mayor de edad para acceder a este contenido.');
        }
            return $response;
        
    }
}
