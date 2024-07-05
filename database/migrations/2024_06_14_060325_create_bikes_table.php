<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBikesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bikes', function (Blueprint $table) {
            $table->id(); // creará el id como clave primaria autonumérico 

            $table->string('marca', 255);                       //marca de la moto
            $table->string('modelo', 255);                      //mmodelo de la moto
            $table->integer('kms')->default(0);                 //kilómetros
            $table->float('precio')->default(0);                //precio
            $table->boolean('matriculada')->default(false);     //está matriculada?
            
            //marcas de tiempo: campos created_at y updated_at
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bikes');
    }
}
