<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ExpertosRubricaN extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
                //
                Schema::create('expertos', function(Blueprint $table){
                    $table->id();
                    $table->string('nombres');
                    $table->integer('apellidos');//debe ser clave foranea tambien
                    $table->text('formacion_academica');
                    $table->string('cargo_actual');
                    $table->string('institucion');
                    $table->string('pais');
                    $table->string('anios_experiencia');
                    $table->timestamps();//crea dos columnas create_add y update_up
                });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::dropIfExists('expertos');
    }
}
