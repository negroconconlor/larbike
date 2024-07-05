<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BikeController;
use App\Http\Controllers\WelcomeController;
use Illuminate\Http\Request;
use App\Http\Controllers\ContactoController;

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

// Rutas para la portada y búsqueda de motos por marca y modelo
Route::get('/', [WelcomeController::class, 'index'])->name('portada');


Route::match(['GET', 'POST'], '/bikes/search', [BikeController::class, 'search'])->name('bikes.search')/*->middleware('adult:13')*/;

// CRUD de motos
Route::resource('/bikes', BikeController::class)/*->middleware('adult:18')*/;

// Formulario de confirmación de eliminación
Route::get('/bikes/{bike}/delete', [BikeController::class, 'delete'])->name('bikes.delete')/*->middleware('adult:21')*/;

// Ruta de fallback
Route::fallback([WelcomeController::class, 'index']);

//ruta para el formulario de contacto
Route::get('/contacto', [ContactoController::class, 'index'])->name('contacto');

//ruta para el envío del email de contacto
Route::post('/contacto', [ContactoController::class, 'send'])->name('contacto.email');

/*
// Rutas de prueba

use App\Models\Bike;

// Ruta con dos parámetros opcionales
Route::get('bikes/search/{marca?}/{modelo?}', function($marca = '', $modelo = '') {
    $bikes = Bike::where('marca', 'like', '%'.$marca.'%')
        ->where('modelo', 'like', '%'.$modelo.'%')
        ->paginate(config('pagination.bikes'));

    return view('bikes.list', ['bikes' => $bikes]);
});

// Rutas de prueba con expresiones regulares
Route::get('test/{id}', function($id) {
    return "U enter via the first route.";
})->where('id', '^\d{1,11}$');

Route::get('test/{dni}', function($dni) {
    return "U enter via the second route.";
})->where('dni', '^[\dXYZ]\d{7}[A-Z]$');

Route::get('test/{otro}', function($otro) {
    return "$otro no es un número ni un DNI.";
});
*/
