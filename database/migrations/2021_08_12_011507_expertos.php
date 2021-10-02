<?php

use Doctrine\DBAL\Schema\Schema as SchemaSchema;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Expertos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('expertos', function (Blueprint $table) {
            $table->id('id');
            $table->string('nombre');
            $table->string('apellidos');
            $table->string('formacion_academica');
            $table->string('cargo_ctual');
            $table->string('institucion');
            $table->string('pais');
            $table->string('anios_experiencia');
            $table->timestamps();
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
        Schema::dropIfExists('expertos');

    }
}
