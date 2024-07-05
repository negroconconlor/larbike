<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BikeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () { // método de la petición
    return view('welcome');     // retorna la vista welcome, la carga

});

/*
Route::get('bikes', [BikeController::class, 'index']);
Route::get('bikes/{bike}', [BikeController::class, 'show']); //lo que va entre llaves es un parámetro variable, basicamente el id

Route::get('bikes/create', [BikeController::class, 'create']);
Route::post('bikes', [BikeController::class, 'store']); 

Route::get('bikes/{bike}/edit', [BikeController::class, 'edit']);
Route::put('bikes/{bike}', [BikeController::class, 'update']);

Route::get('bikes/{bike}/delete', [BikeController::class,'delete']);
Route::delete('bikes/{bike}', [BikeController::class,'destroy']); */


//CRUD de motos
Route::resource('bikes', BikeController::class);


//ruta para la confirmación de eliminación
Route::get('bikes/{bike}/delete', [BikeController::class, 'delete'])->name('bikes.delete');
