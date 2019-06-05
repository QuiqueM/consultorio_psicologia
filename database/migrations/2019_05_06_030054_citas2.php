<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Citas2 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('sitio2')->create('cita2', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('fecha');
            $table->string('start');
            $table->string('end');
            $table->string('color');
            $table->string('textcolor');
            $table->integer('id_paciente');
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
        Schema::connection('sitio2')->dropIfExists('cita2');
    }
}
