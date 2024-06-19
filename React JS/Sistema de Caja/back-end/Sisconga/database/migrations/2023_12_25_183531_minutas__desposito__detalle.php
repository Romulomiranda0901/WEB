<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MinutasDespositoDetalle extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tesoreria.minuta_deposito_detalle', function (Blueprint $table) {
            $table->id();
            $table->integer('id_minuta');
            $table->foreign("id_minuta")
                ->references("id")
                ->on("tesoreria.minuta_deposito");
            $table->integer('id_cuenta_banco');
            $table->foreign("id_cuenta_banco")
                ->references("id")
                ->on("general.cuenta_banco");
            $table->decimal('monto', 8, 2);
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
        Schema::dropIfExists('tesoreria.minuta_deposito_detalle');
    }

}
