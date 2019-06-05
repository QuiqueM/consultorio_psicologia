<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Expediente extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('sitio1')->create('expedientes1', function (Blueprint $table) {
            $table->increments('id');
            $table->string('avance');
            $table->string('notas');
            $table->string('situacion');
            $table->string('fecha');
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
        Schema::connection('sitio1')->dropIfExists('expedientes1');
    }
}
