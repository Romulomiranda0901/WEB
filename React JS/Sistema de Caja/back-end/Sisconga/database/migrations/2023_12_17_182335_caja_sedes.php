<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CajaSedes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('general.caja_sede', function (Blueprint $table) {
            $table->id();
            $table->integer('id_caja');
            $table->foreign("id_caja")
                ->references("id")
                ->on("general.organicas_cajas")
                ->onDelete("cascade");
            $table->integer('id_sede')->nullable();
            $table->foreign("id_sede")
                ->references("id")
                ->on("general.sedes")
                ->onDelete("cascade");
            $table->integer('id_subsedes')->nullable();
            $table->foreign("id_subsedes")
                ->references("id")
                ->on("general.subsedes")
                ->onDelete("cascade");
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
        Schema::dropIfExists('general.permisos_usuario_caja');
    }
}
