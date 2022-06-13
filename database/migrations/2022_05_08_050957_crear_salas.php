<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CrearSalas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('salas', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->unsignedBigInteger('tipo_sala');
            $table->unsignedBigInteger('visibilidad_sala');
            $table->timestamps();
            $table->foreign('tipo_sala')->references('id')->on('tipo_salas');
            $table->foreign('visibilidad_sala')->references('id')->on('visibilidad_salas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Salas');
    }
}
