<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class paciente2 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('sitio2')->create('paciente2', function (Blueprint $table) {
            $table->integer('id');
            $table->string('nombre');
            $table->string('a_paterno');
            $table->string('a_materno');
            $table->string('calle');
            $table->string('numero');
            $table->string('colonia');
            $table->integer('edad');
            $table->string('telefono');
            $table->string('telefono_contacto');
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
        Schema::connection('sitio2')->dropIfExists('paciente2');
    }
}
