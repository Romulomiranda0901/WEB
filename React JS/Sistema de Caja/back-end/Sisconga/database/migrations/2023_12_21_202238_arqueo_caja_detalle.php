<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ArqueoCajaDetalle extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tesoreria.arqueo_caja_detalle', function (Blueprint $table) {
            $table->id();
            $table->integer('id_tipo_moneda');
            $table->foreign("id_tipo_moneda")
                ->references("id")
                ->on("general.tipo_moneda");
            $table->integer('id_cat_denominacion');
            $table->foreign("id_cat_denominacion")
                ->references("id")
                ->on("general.cat_denominaciones");
            $table->string('cantidad','20');
            $table->integer('id_arqueo');
            $table->foreign("id_arqueo")
                ->references("id")
                ->on("tesoreria.arqueo_caja");
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
        Schema::dropIfExists('tesoreria.arqueo_caja_detalle');
    }
}
