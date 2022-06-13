<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CrearTipoUsuario extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tipo_usuarios', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('descripcion');
            $table->timestamps();
        });
        if (Schema::getColumnListing('tipo_usuarios') == [] || Schema::getColumnListing('tipo_usuarios') == ['id', 'created_at', 'updated_at']) {
            $tipos = [
                ['nombre' => 'Administrador', 'descripcion' => 'Administrador del sistema'],
                ['nombre' => 'Usuario', 'descripcion' => 'Usuario del sistema'],
            ];
            DB::table('tipo_usuarios')->insert($tipos);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('TipoUsuarios');
    }
}
