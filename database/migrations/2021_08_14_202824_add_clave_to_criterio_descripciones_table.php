<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddClaveToCriterioDescripcionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('criterio_descripciones', function (Blueprint $table) {
            //
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
        Schema::table('criterio_descripciones', function (Blueprint $table) {
            //
        });
    }
}
