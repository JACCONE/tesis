<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class PreguntasCuestionarios extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('preguntas_cuestionarios', function(Blueprint $table){
            $table->id();
            $table->text('pregunta');
            $table->integer('tipo');
            $table->text('cabecera');
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
        Schema::dropIfExists('preguntas_cuestionarios');
    }
}
