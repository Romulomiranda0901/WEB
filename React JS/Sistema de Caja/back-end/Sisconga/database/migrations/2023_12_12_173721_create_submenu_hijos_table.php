<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubmenuHijosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('configuracion.submenu_hijos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre',255);
            $table->string('icono',20);
            $table->char('activo',2)->default('SI');
            $table->char('eliminado',2)->default('NO');
            $table->unsignedBigInteger("id_submenu");
            $table->foreign("id_submenu")
                ->references("id")
                ->on("configuracion.submenus")
                ->onDelete("cascade");
            $table->string('url',255);
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
        Schema::dropIfExists('submenu_hijos');
    }
}
