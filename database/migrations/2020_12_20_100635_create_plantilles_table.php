<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlantillesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plantilles', function (Blueprint $table)
        {
            $table->increments('plantilla_id');

            $table->integer('plantilla_gimcana_id');
            $table->string('plantilla_punt_codi', 25);
            $table->string('plantilla_pregunta_codi', 25);
            $table->string('plantilla_resposta_codi', 25);
            $table->integer('plantilla_ordre');
            $table->integer('plantilla_punts');

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
        Schema::dropIfExists('plantilles');
    }
}
