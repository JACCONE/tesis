<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class EvaluacionParesDocente extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('evaluacion_pares_docente', function(Blueprint $table){
            $table->id();
            $table->integer('id_tarea');
            $table->integer('id_estudiante');
            $table->integer('id_criterio');
            $table->integer('id_nivel');
            $table->text('observacion');
            $table->timestamp('fecha_evaluacion');
            $table->timestamps();
            $table->foreign("id_tarea")
            ->references("id")
            ->on("tareas_envio")
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
        Schema::dropIfExists('evaluacion_pares_docente');
    }
}
