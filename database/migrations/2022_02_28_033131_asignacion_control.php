<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AsignacionControl extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('asignacion_control', function(Blueprint $table){
            $table->id();
            $table->integer('id_docente');
            $table->integer('id_tarea');
            $table->timestamp('fecha_asignacion');
            $table->timestamp('fecha_final');
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
        Schema::dropIfExists('asignacion_control');
    }
}
