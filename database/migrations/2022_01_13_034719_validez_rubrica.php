<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ValidezRubrica extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('validez_satisfaccion', function(Blueprint $table){
            $table->id();
            $table->bigInteger('id_personal');
            $table->integer('id_rubrica');
            $table->integer('id_pregunta');
            $table->integer('calificacion');
            $table->timestamps();
            $table->foreign("id_pregunta")
            ->references("id")
            ->on("preguntas_cuestionarios")
            ->onDelete("cascade")
            ->onUpdate("cascade");
            $table->foreign("id_rubrica")
            ->references("id")
            ->on("rubricas")
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
        Schema::dropIfExists('validez_rubrica');
    }
}
