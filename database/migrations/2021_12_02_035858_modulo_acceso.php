<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModuloAcceso extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('modulo_acceso', function (Blueprint $table) {
            $table->id();
            $table->integer('id_modulo');
            $table->string('rol');
            $table->string('type');
            $table->timestamps();
            $table->foreign("id_modulo")
            ->references("id")
            ->on("modulos")
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
        Schema::dropIfExists('modulo_acceso');
    }
}
