<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsuariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('configuracion.usuarios', function (Blueprint $table) {
            $table->id();
            $table->string('nombres',255);
            $table->string('apellidos',255);
            $table->string('inss',255);
            $table->string('password',255);
            $table->string('correo',255);
            $table->char('activo',2)->default('SI');
            $table->char('eliminado',2)->default('NO');
            $table->unsignedBigInteger("id_rol");
            $table->foreign("id_rol")
                ->references("id")
                ->on("configuracion.rols")
                ->onDelete("cascade");
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
        Schema::dropIfExists('usuarios');
    }
}
