<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class EvaluacionesSuficiencia extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('evaluaciones_suficiencia', function(Blueprint $table){
            $table->id();
            $table->integer('id_evaluacion');
            $table->integer('id_criterio');
            $table->string('suficiencia');
            $table->timestamps();//crea dos columnas create_add y update_up
            $table->foreign("id_evaluacion")
            ->references("id")
            ->on("evaluaciones")
            ->onDelete("cascade")
            ->onUpdate("cascade"); 
            $table->foreign("id_criterio")
            ->references("id")
            ->on("rubrica_criterios")
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
        Schema::dropIfExists('evaluaciones_suficiencia');
    }
}
