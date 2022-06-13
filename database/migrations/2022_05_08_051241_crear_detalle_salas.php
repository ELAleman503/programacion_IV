<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CrearDetalleSalas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalle_salas', function (Blueprint $table) {
            $table->unsignedBigInteger('sala_id');
            $table->unsignedBigInteger('usuario_id');
            $table->timestamps();
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
        Schema::dropIfExists('detalle_salas');
    }
}
