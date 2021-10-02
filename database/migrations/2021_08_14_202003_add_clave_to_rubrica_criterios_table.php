<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddClaveToRubricaCriteriosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('rubrica_criterios', function (Blueprint $table) {
            //
            $table->foreign("id_rubrica")
            ->references("id")
            ->on("rubricas")
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
        Schema::table('rubrica_criterios', function (Blueprint $table) {
            //
        });
    }
}
