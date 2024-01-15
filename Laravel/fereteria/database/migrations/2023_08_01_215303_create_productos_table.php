<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            $table->string('nombres');
            $table->string('descripcion',255);
            $table->double('precio');
            $table->integer('cantidad');
            $table->string('activo')->default('SI');
            $table->string('eliminado')->default('NO');
            $table->integer('usuario_c');
            $table->integer('usuario_m');
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
        Schema::dropIfExists('productos');
    }
}
