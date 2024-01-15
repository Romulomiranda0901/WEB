<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('configuracion.menus', function (Blueprint $table) {
            $table->id();
            $table->string('nombre',255);
            $table->string('icono',20);
            $table->char('activo',2)->default('SI');
            $table->char('eliminado',2)->default('NO');
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
        Schema::dropIfExists('menus');
    }
}
