<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CuentaPorPagarDetalle extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tesoreria.cuenta_por_pagar_detalle', function (Blueprint $table) {
            $table->id();
            $table->integer('id_cuenta_por_pagar');
            $table->foreign("id_cuenta_por_pagar")
                ->references("id")
                ->on("tesoreria.cuenta_por_pagar");
            $table->integer('id_cliente');
            $table->foreign("id_cliente")
                ->references("id")
                ->on("general.clientes");
            $table->string('monto','255');
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
        Schema::dropIfExists('tesoreria.cuenta_por_pagar_detalle');
    }
}
