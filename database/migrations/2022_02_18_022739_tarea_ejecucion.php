<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TareaEjecucion extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('tareas_ejecucion', function(Blueprint $table){
            $table->id();
            $table->integer('id_estudiante');
            $table->integer('id_tarea');
            $table->text('link_drive');
            $table->timestamp('fecha_envio');
            $table->timestamps();
            $table->foreign("id_tarea")
            ->references("id")
            ->on("tareas_envio")
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
        Schema::dropIfExists('tareas_ejecucion');
    }
}
