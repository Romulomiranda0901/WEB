<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEntregablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entregables', function (Blueprint $table) {
            $table->id();
            $table->foreignId("desafio_id")->constrained();
            $table->foreignId("criterio_id")->constrained();
            $table->foreignId("tipo_archivo_id")->constrained();
            $table->foreignId("equipo_id")->constrained();
            $table->string('nombre');
            $table->string('descripcion');
            $table->string('link');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('entregables');
    }
}
