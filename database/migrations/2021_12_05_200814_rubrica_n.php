<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RubricaN extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('rubricas', function(Blueprint $table){
            $table->id();
            $table->integer('id_asignatura');
            $table->integer('id_docente');//debe ser clave foranea tambien
            $table->string('nombre');
            $table->text('descripcion');
            $table->string('estado');
            $table->timestamps();//crea dos columnas create_add y update_up
         /*   $table->foreign("id_asignatura")
            ->references("id")
            ->on("asignaturas")
            ->onDelete("cascade")
            ->onUpdate("cascade");  */
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
        Schema::dropIfExists('rubricas');
    }
}
