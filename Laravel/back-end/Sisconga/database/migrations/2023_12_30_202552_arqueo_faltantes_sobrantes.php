<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ArqueoFaltantesSobrantes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tesoreria.arqueofaltantessobrante', function (Blueprint $table) {
            $table->id();
            $table->integer('id_tipo_moneda');
            $table->foreign("id_tipo_moneda")
                ->references("id")
                ->on("general.tipo_moneda");
            $table->integer('id_caja');
            $table->foreign("id_caja")
                ->references("id")
                ->on("general.organicas_cajas");
            $table->integer('id_arqueo');
            $table->foreign("id_arqueo")
                ->references("id")
                ->on("tesoreria.arqueo_caja");
            $table->decimal('monto', 8, 2);
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
        Schema::dropIfExists('tesoreria.arqueofaltantessobrante');
    }
}
