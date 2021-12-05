<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CriterioItemsN extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('criterios_items', function (Blueprint $table) {
            $table->id();
            $table->integer('id_criterio');
            $table->string('nombre');
            $table->text('andamiaje');
            $table->timestamps();
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
        Schema::dropIfExists('criterios_items');
    }
}
