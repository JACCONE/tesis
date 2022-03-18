<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AsignacionEstudiante extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('asignacion_estudiante', function(Blueprint $table){
            $table->id();
            $table->integer('id_asignacion');
            $table->integer('id_estudiante');
            $table->integer('id_asignado');
            $table->integer('estado');
            $table->timestamps();
            $table->foreign("id_asignacion")
            ->references("id")
            ->on("asignacion_control")
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
        Schema::dropIfExists('asignacion_estudiante');
    }
}
