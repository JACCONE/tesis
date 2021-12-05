<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class EvaluacionRubricaN extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('evaluaciones', function(Blueprint $table){
            $table->id();
            $table->integer('id_rubrica');
            $table->integer('id_experto');//debe ser clave foranea tambien
            $table->text('estado');
            $table->timestamps();//crea dos columnas create_add y update_up
            $table->foreign("id_rubrica")
            ->references("id")
            ->on("rubricas")
            ->onDelete("cascade")
            ->onUpdate("cascade"); 
            $table->foreign("id_experto")
            ->references("id")
            ->on("expertos")
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
        Schema::dropIfExists('evaluaciones');
    }
}
