<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Isncribe extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('sitio2')->create('inscribe2', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_paciente');
            $table->integer('id_evento');
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
        Schema::connection('sitio2')->dropIfExists('inscribe2');
    }
}
