<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Recibos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tesoreria.recibos', function (Blueprint $table) {
            $table->id();
            $table->integer('id_cliente');
            $table->foreign("id_cliente")
                ->references("id")
                ->on("general.clientes");
            $table->integer('id_tipo_moneda');
            $table->foreign("id_tipo_moneda")
                ->references("id")
                ->on("general.tipo_moneda");
            $table->integer('id_caja');
            $table->foreign("id_caja")
                ->references("id")
                ->on("general.organicas_cajas");
            $table->integer('id_usuario');
            $table->foreign("id_usuario")
                ->references("id")
                ->on("configuracion.usuarios");
            $table->integer('id_forma_pago');
            $table->foreign("id_forma_pago")
                ->references("id")
                ->on("general.forma_pago");
            $table->string('numero_forma_pago','100')->nullable();
            $table->decimal('monto', 8, 2);
            $table->string('numero_recibo','100');
            $table->string('finalizado','10')->default('NO');
            $table->integer('anyo');
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
        Schema::dropIfExists('tesoreria.recibos');
    }
}
