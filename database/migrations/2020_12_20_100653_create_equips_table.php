<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEquipsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('equips', function (Blueprint $table)
        {
            $table->increments('equip_id');

            $table->integer('equip_gimcana_id');
            $table->string('equip_dispositiu', 100);
            $table->string('equip_nom', 100);
            $table->string('equip_email', 100)->unique();
            $table->dateTime('equip_inici');
            $table->dateTime('equip_fi')->nullable();
            $table->integer('equip_num_respostes_correctes')->nullable();
            $table->integer('equip_punts_respostes_correctes')->nullable();
            $table->boolean('equip_ordre_correcte')->nullable();
            $table->integer('equip_num_respostes_en_ordre')->nullable();
            $table->integer('equip_punts_respostes_en_ordre')->nullable();

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
        Schema::dropIfExists('equips');
    }
}
