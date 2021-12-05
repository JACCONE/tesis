<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Modulos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('modulos', function(Blueprint $table){
            $table->id();
            $table->string('nombre_modulo');
            $table->string('plantilla_modulo');
            $table->string('icon');
            $table->text('extra')->nullable();
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
        Schema::dropIfExists('modulos');
    }
}
