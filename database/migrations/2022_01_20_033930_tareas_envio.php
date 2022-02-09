<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TareasEnvio extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('tareas_envio', function(Blueprint $table){
            $table->id();
            $table->integer('id_docente');
            $table->integer('id_periodo');
            $table->integer('id_asignatura');
            $table->integer('paralelo');
            $table->integer('id_rubrica');
            $table->text('nombre');
            $table->text('descripcion');
            $table->integer('nota_maxima');
            $table->timestamp('fecha_inicio');
            $table->timestamp('fecha_fin');
            $table->string('link')->nullable();
            $table->string('estado');
            $table->timestamps();
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
        Schema::dropIfExists('tareas_envio');
    }
}
