<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RecibosDetalles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tesoreria.recibos_detalle', function (Blueprint $table) {
            $table->id();
            $table->integer('id_recibos');
            $table->foreign("id_recibos")
                ->references("id")
                ->on("tesoreria.recibos");
            $table->integer('id_mes')->nullable();
            $table->foreign("id_mes")
                ->references("id")
                ->on("general.meses");
            $table->integer('id_tipo_pagp');
            $table->foreign("id_tipo_pagp")
                ->references("id")
                ->on("general.tipopago");
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
        Schema::dropIfExists('tesoreria.recibos_detalle');
    }
}
