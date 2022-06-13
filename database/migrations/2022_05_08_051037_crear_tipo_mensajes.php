<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CrearTipoMensajes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tipo_mensajes', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->timestamps();
        });
        if (Schema::getColumnListing('tipo_mensajes') == []) {
            $tipos = [
                ['nombre' => 'Texto'],
                ['nombre' => 'Imagen'],
                ['nombre' => 'Video'],
                ['nombre' => 'Audio'],
                ['nombre' => 'Archivo'],
            ];
            DB::table('tipo_mensajes')->insert($tipos);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('TipoMensajes');
    }
}
