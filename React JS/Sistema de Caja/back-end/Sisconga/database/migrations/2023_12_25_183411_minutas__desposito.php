<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MinutasDesposito extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tesoreria.minuta_deposito', function (Blueprint $table) {
            $table->id();
            $table->integer('numuero_minuta');
            $table->integer('numuero_deposito');
            $table->integer('id_arqueo');
            $table->foreign("id_arqueo")
                ->references("id")
                ->on("tesoreria.arqueo_caja");
            $table->integer('id_usuario');
            $table->foreign("id_usuario")
                ->references("id")
                ->on("configuracion.usuarios");
            $table->integer('anyo');
            $table->string('finalizado','10')->default('NO');
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
        Schema::dropIfExists('tesoreria.minuta_deposito');
    }

}
