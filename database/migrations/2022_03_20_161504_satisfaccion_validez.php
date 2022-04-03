<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SatisfaccionValidez extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('satisfaccion_validez', function(Blueprint $table){
        $table->id();
        $table->integer('id_rubrica');
        $table->integer('id_estudiante');
        $table->integer('id_pregunta');
        $table->integer('calificacion');
        $table->timestamp('fecha_cuestionario');
        $table->timestamps();
        $table->foreign("id_rubrica")
        ->references("id")
        ->on("rubricas")
        ->onDelete("cascade")
        ->onUpdate("cascade"); 
        $table->foreign("id_pregunta")
        ->references("id")
        ->on("preguntas_cuestionarios")
        ->onDelete("cascade")
        ->onUpdate("cascade"); 
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
        Schema::dropIfExists('satisfaccion_validez');
    }
}
