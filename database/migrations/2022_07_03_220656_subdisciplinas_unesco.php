<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SubdisciplinasUnesco extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('subdisciplinas_unesco', function(Blueprint $table){
            $table->id();
            $table->integer('id_disciplina');
            $table->text('nombre');
            $table->integer('estado');
            $table->timestamps();
            $table->foreign("id_disciplina")
            ->references("id")
            ->on("disciplinas_unesco")
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
        Schema::dropIfExists('subdisciplinas_unesco');
    }
}
