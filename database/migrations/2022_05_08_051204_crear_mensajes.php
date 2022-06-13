<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CrearMensajes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mensajes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tipo_mensaje');
            $table->unsignedBigInteger('sala_id');
            $table->unsignedBigInteger('usuario_id');
            $table->string('mensaje');
            $table->timestamps();
            $table->foreign('tipo_mensaje')->references('id')->on('tipo_mensajes');
            $table->foreign('sala_id')->references('id')->on('salas');
            $table->foreign('usuario_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Mensajes');
    }
}
