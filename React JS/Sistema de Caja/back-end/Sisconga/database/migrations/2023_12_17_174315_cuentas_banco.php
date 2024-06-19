<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CuentasBanco extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('general.cuenta_banco', function (Blueprint $table) {
            $table->id();
            $table->integer('id_banco');
            $table->foreign("id_banco")
                ->references("id")
                ->on("general.banco");
            $table->string('cuenta');
            $table->string('tipo_cuenta');
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
        Schema::dropIfExists('general.cuenta_banco');
    }
}
