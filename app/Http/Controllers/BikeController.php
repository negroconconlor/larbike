<?php

namespace App\Http\Controllers;
use App\Models\Bike;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Storage;


class BikeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        //recupera las motodos de la BDD usando el modelo
        //ordenado por id descendente y paginación de 10 resultados por página
        $bikes = Bike::orderBy('id', 'DESC')->paginate(config('pagination.bikes', 10));

        //total de motos en la BDD (para mostrar)
        // $total= Bike::count(); //lo transladaremos a un ViewComposer

        //cargar la vista con el listado de motos
        return view('bikes.list',['bikes'=>$bikes]);
        }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('bikes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        // validación de datos de entrada mediante validator
        $request->validate([
            'marca' => 'required|max:255',
            'modelo' => 'required|max:255',
            'precio' => 'required|numeric',
            'kms' => 'required|integer',
            'matriculada' => 'sometimes',
            'imagen' => 'sometimes|file|image|mimes:jpg,png,gif,webp|max:2048'
        ]);

        /*   validación temporal para el ejemplo
        if($request->kms<0)
            return back()->withinput($request->except('kms'))->withErrors(['error'=>'Los kms no pueden ser negativos. ']);*/
        //creación y guardado de la nueva moto con todos los datos POST
        // $bike=Bike::create($request->only(['marca','modelo','precio', 'kms', 'matriculada']));
        
        //recuperar datos del formulario excepto la imagen
        $datos = $request->only(['marca', 'modelo', 'precio', 'kms', 'matriculada']);

        //el valor por defecto  para la imagen será NULL
        $datos += ['imagen' => NULL];

        //recuperación de la imagen 
        if($request->hasFile('imagen')){
            //sube la imagen al directorio indicado en el fichero config
            $ruta = $request->file('imagen')->store(config('filesystems.bikesImageDir'));
        
            //nos quedamos solo con el nombre del fichero para añadiro a la BDD
            $datos['imagen'] = pathinfo($ruta, PATHINFO_BASENAME);
        }

        //creacion y guardado de la nuevo moto con los datos
        $bike = Bike::create($datos);

        //redirecciona a los detalles de la moto creada
        return redirect()
        ->route('bikes.show', $bike->id)
        ->with('success', "Moto $bike->marca $bike->modelo añadidada satisfactoriamente")
        ->cookie('lastInsertID', $bike->id, 0); //adjuntamos una cookie
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //recupera la moto con el id deseado
        //si no la encuentra generará un error 404
        $bike=Bike::findOrFail($id);

        //carga la vista correspondiente y le pasa la moto
        return view('bikes.show', ['bike'=>$bike]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //recupera la moto con el id deseado
        //si no la encuentra generará un error 404
        $bike=Bike::findOrFail($id);

        //carga la visat con el formulario para modificar la moto
        return view('bikes.update', ['bike'=>$bike]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Bike $bike)
    {
        //validacion de datos
        $request->validate([
            'marca' => 'required|max:255',
            'modelo' => 'required|max:255',
            'precio' => 'required|numeric',
            'kms' => 'required|integer',
            'matriculada' => 'sometimes',
            'imagen' => 'sometimes|file|image|mimes:jpg,png,gif,webp|max:2048'
        ]);

        //toma los datos del fromulario
        $datos = $request->only('marca', 'modelo', 'kms', 'precio');

        //mira si llega el checkbox y pone 1 o 0 dependiendo de si llega o no
        $datos += $request->has('matriculada') ? ['matriculada'=>1] : ['matriculada'=>0];

        /*$bike=Bike::findOrFail($id); // recupera la moto de la BDD
        $bike->update($request->all()+['matriculada'=>0]);*/

        //si llega una nueva imagen..
        if($request->hasFile('imagen')){
            //marcamos la imagen antigua para ser borrada si el update va bien
            if($bike->imagen)
                $aBorrar = config('filesystems.bikesImageDir').'/'.$bike->imagen;
            
            //sube la imagen al directorio indicado en el fichero de config
            $imagenNueva = $request->file('imagen')->store(config('filesystems.bikesImageDir'));

            //nos quedamos solo con el nombre del fichero para añadirlo a la BDD
            $datos['imagen'] = pathinfo($imagenNueva, PATHINFO_BASENAME);
        }

        //en caso de que nos pidan eliminar la imagen
        if($request->filled('eliminarimagen') && $bike->imagen){
            $datos['imagen'] = NULL;
            $aBorrar = config('filesystems.bikesImageDir').'/'.$bike->imagen;
        }

        //al actualizar debemos tener en cuenta varias cosas:
        if($bike->update($datos)){  // si todo va bien
            if(isset($aBorrar))
                Storage::delete($aBorrar); // borramos foto antigua
            
        }else{ //si algo falla
            if(isset($imagenNueva))
                Storage::delete($imagenNueva); //borramos la nueva foto
        }

        //carga la misma vista y muestra el mensaje de éxito
        return back()->with('success', "Moto $bike->marca $bike->modelo actualizada");

        /*
        //encola las cookies
        Cookie::queue('lastUpdateID', $bike->id,0);
        Cookie::queue('lastUpdateDate', now(),0);*/
    }

    

    /** 
     * Muestra el formulario de confirmación de borrado de moto.
     * 
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id){
        //recupera la moto a eliminar
        $bike=Bike::findOrFail($id);
        
        //muestra la vista de confirmación de eliminación
        return view('bikes.delete', ['bike'=>$bike]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Bike $bike){
        /*//busca la moto seleccionada
        $bike=Bike::findOrFaiL($id);
        
        //la borra de la base de datos
        $bike->delete();*/

        //si se consigue eliminar la moto y tiene foto...
        if($bike->delete() && $bike->imagen){
            //elimina el fichero
            Storage::delete(config('filesystems.bikesImageDir').'/'.$bike->imagen);
        }

        /*//veamos que devuelve redirect(URL)
        dd(redirect('/bikes'));*/
        return redirect('/bikes')->with('success', "Moto $bike->marca $bike->modelo eliminada");
    }
/*
    //ZONA PARA PRUEBAS: al tanto que venen curves....
    Route::get('/prueba', function(Request $request){
        $respuesta = "PATH: ".$request->path()."<br>";
        $respuesta .= "URL ".$request->url()."<br>";
        $respuesta .= "FULLURL".$request->fullUrl()."<br>";
        $respuesta .= "IP CLIENTE: ".$request->getClientIp()."<br>";

    });
*/

}
