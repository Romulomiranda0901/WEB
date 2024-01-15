<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Clientes extends Migration
{
    /**
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('general.clientes', function (Blueprint $table) {
            $table->id();
            $table->string('carnet','255');
            $table->string('nombres','255');
            $table->string('apellidos','255');
            $table->integer('id_carrera_sede');
            $table->foreign("id_carrera_sede")
                ->references("id")
                ->on("general.carrera_sede");
            $table->integer('id_turno');
            $table->foreign("id_turno")
                ->references("id")
                ->on("general.turno");
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
        Schema::dropIfExists('general.clientes');
    }
}
