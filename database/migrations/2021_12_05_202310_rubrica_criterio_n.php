<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RubricaCriterioN extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('rubrica_criterios', function(Blueprint $table){
            $table->id();//id_criterio
            $table->integer('id_rubrica');
            $table->string('nombre');
            $table->string('porcentaje');
            $table->timestamps();//crea dos columnas create_add y update_up
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
        Schema::dropIfExists('rubrica_criterios');
    }
}
