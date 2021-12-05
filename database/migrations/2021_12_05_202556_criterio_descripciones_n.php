<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CriterioDescripcionesN extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('criterio_descripciones', function (Blueprint $table) {
            $table->id();
            $table->integer('id_criterio');
            $table->integer('id_nivel');
            $table->text('descripcion');
            $table->timestamps();
            $table->foreign("id_criterio")
            ->references("id")
            ->on("rubrica_criterios")
            ->onDelete("cascade")
            ->onUpdate("cascade"); 
            $table->foreign("id_nivel")
            ->references("id")
            ->on("rubrica_niveles")
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
    }
}
