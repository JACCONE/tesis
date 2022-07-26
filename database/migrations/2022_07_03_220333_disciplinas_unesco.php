<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DisciplinasUnesco extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    
    {
        //
        Schema::create('disciplinas_unesco', function(Blueprint $table){
            $table->id();
            $table->integer('id_campo');
            $table->text('nombre');
            $table->integer('estado');
            $table->timestamps();
            $table->foreign("id_campo")
            ->references("id")
            ->on("campos_unesco")
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
        Schema::dropIfExists('campos_unesco');
    }
}
