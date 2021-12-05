<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RubricaNivelesN extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('rubrica_niveles', function (Blueprint $table) {
            $table->id();
            $table->integer('id_rubrica');
            $table->integer('valoracion');
            $table->string('nombre');
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
        Schema::dropIfExists('rubrica_niveles');
    }
}
