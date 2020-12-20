<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRespostesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('respostes', function (Blueprint $table)
        {
            $table->bigincrements('resposta_id');

            $table->integer('resposta_gimcana_id');
            $table->string('resposta_dispositiu', 100);
            $table->integer('resposta_equip_id');
            $table->string('resposta_punt_codi', 25);
            $table->string('resposta_pregunta_codi', 25);
            $table->string('resposta_resposta_codi', 25);
            $table->integer('resposta_ordre');

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
        Schema::dropIfExists('respostes');
    }
}
