<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AsignaturaN extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('asignaturas', function (Blueprint $table) {
            $table->id('id');
            $table->integer('id_subdisciplina');
            $table->string('nombre');
            $table->string('estado');
            $table->timestamps();
           /*  $table->foreign("id_subdisciplina")
            ->references("id")
            ->on("subdisciplinas_unesco")
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
        Schema::dropIfExists('asignaturas');
    }
}
