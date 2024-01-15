<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePermisosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('configuracion.permisos', function (Blueprint $table) {
            $table->id();
            $table->char('activo',2)->default('SI');
            $table->char('eliminado',2)->default('NO');
            $table->unsignedBigInteger("id_rol");
            $table->foreign("id_rol")
                ->references("id")
                ->on("configuracion.rols")
                ->onDelete("cascade");
            $table->unsignedBigInteger("id_menu")->nullable();
            $table->foreign("id_menu")
                ->references("id")
                ->on("configuracion.menus")
                ->onDelete("cascade");
            $table->unsignedBigInteger("id_permis");
            $table->foreign("id_permis")
                ->references("id")
                ->on("configuracion.permis")
                ->onDelete("cascade");
            $table->unsignedBigInteger("id_submenu")->nullable();
            $table->foreign("id_submenu")
                ->references("id")
                ->on("configuracion.submenus")
                ->onDelete("cascade");
            $table->unsignedBigInteger("id_submenuhijo")->nullable();
            $table->foreign("id_submenuhijo")
                ->references("id")
                ->on("configuracion.submenu_hijos")
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
        Schema::dropIfExists('permisos');
    }
}
