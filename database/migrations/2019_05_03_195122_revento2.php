<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Revento2 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('sitio2')->create('revento2', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->string('ubicacion');
            $table->string('fecha');
            $table->string('imagen');
            $table->string('hora');
            $table->string('descripcion');
            $table->integer('id_psicologo');
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
        Schema::connection('sitio2')->dropIfExists('revento2');
    }
}
