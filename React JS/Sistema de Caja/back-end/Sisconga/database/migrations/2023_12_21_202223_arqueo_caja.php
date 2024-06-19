<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ArqueoCaja extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tesoreria.arqueo_caja', function (Blueprint $table) {
            $table->id();
            $table->integer('id_caja');
            $table->foreign("id_caja")
                ->references("id")
                ->on("general.organicas_cajas");
            $table->integer('id_usuario');
            $table->foreign("id_usuario")
                ->references("id")
                ->on("configuracion.usuarios");
            $table->string('numero_arqueo','100');
            $table->integer('anyo');
            $table->string('observacion','255');
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
        Schema::dropIfExists('tesoreria.arqueo_caja');
    }
}
