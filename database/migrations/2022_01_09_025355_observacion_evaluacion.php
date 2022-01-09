<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ObservacionEvaluacion extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('observacion_evaluacion', function(Blueprint $table){
            $table->id();
            $table->integer('id_evaluacion');
            $table->integer('id_rubrica');
            $table->text('observacion');
            $table->timestamps();//crea dos columnas create_add y update_up
            $table->foreign("id_evaluacion")
            ->references("id")
            ->on("evaluaciones")
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
        Schema::dropIfExists('observacion_evaluacion');
    }
}
