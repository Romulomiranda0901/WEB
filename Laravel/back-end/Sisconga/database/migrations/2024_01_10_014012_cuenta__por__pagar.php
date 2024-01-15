<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CuentaPorPagar extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tesoreria.cuenta_por_pagar', function (Blueprint $table) {
            $table->id();
            $table->integer('id_tipopago');
            $table->foreign("id_tipopago")
                ->references("id")
                ->on("general.tipopago");
            $table->integer('id_mes')->nullable();
            $table->foreign("id_mes")
                ->references("id")
                ->on("general.meses");
            $table->integer('id_caja');
            $table->foreign("id_caja")
                ->references("id")
                ->on("general.organicas_cajas");
            $table->string('numero_documento','255');
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
        Schema::dropIfExists('tesoreria.cuenta_por_pagar');
    }
}
