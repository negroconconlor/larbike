<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Shop extends Model{
    //campos donde se permiten asignaciones masivas
    //es una protección ante inyección de datos
    protected $fillable = ['nombre', 'poblacion', 'telefono'];

};

