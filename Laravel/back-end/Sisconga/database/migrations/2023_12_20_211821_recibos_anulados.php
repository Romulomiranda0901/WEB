<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RecibosAnulados extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tesoreria.recibos_anulados', function (Blueprint $table) {
            $table->id();
            $table->integer('id_recibos');
            $table->foreign("id_recibos")
                ->references("id")
                ->on("tesoreria.recibos");
            $table->integer('id_usuario');
            $table->foreign("id_usuario")
                ->references("id")
                ->on("configuracion.usuarios");
            $table->string('observacion',255);
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
        Schema::dropIfExists('tesoreria.recibos_anulados');
    }
}
