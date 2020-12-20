<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGimcanesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gimcanes', function (Blueprint $table)
        {
            $table->increments('gimcana_id');

            $table->string('gimcana_nom', 100)->unique();
            $table->date('gimcana_data');
            $table->string('gimcana_patro', 25);

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
        Schema::dropIfExists('gimcanes');
    }
}
