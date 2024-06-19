<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class PermisoUsuarioCaja extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('general.permisos_usuario_caja', function (Blueprint $table) {
            $table->id();
            $table->integer('id_usuario');
            $table->foreign("id_usuario")
                ->references("id")
                ->on("configuracion.usuarios");
            $table->integer('id_caja');
            $table->foreign("id_caja")
                ->references("id")
                ->on("general.organicas_cajas");
            $table->char('activo',2)->default('SI');
            $table->char('eliminado',2)->default('NO');
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
        Schema::dropIfExists('general.permisos_usuario_caja');
    }
}
