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
            $table->string('nombre');
            $table->string('estado');
            $table->timestamps();//crea dos columnas create_add y update_up
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
        Schema::dropIfExists('disciplinas_unesco');
    }
}
