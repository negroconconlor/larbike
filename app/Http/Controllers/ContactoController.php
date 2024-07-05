<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactoController extends Controller{
    
    //método index( ) para que muestr el formulario de contacto que acabamos de crear
    public function index(){
        return view('contacto');
    }
}
