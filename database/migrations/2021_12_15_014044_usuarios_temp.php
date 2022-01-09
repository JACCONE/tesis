<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UsuariosTemp extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('expertos_temp_users', function(Blueprint $table){
            $table->id();
            $table->text('usuario');
            $table->text('password');
            $table->integer('status');
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
        Schema::dropIfExists('expertos_temp_users');
    }
}
