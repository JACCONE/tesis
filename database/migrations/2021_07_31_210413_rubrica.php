<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Rubrica extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('rubrica', function(Blueprint $table){
            $table->id();
            $table->String('id_rubrica');
            $table->string('nombre');
            $table->text('descripcion');
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
        Schema::dropIfExists('rubrica');
    }
}
