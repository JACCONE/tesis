<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CamposUnesco extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('campos_unesco', function(Blueprint $table){
            $table->id();
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
        Schema::dropIfExists('campos_unesco');
    }
}
