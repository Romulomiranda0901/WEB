<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDesafiosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('desafios', function (Blueprint $table) {
            $table->id();
            $table->foreignId("evento_id")->constrained();
            $table->foreignId("categoria_id")->constrained();
            $table->foreignId("patrocinadors_id")->constrained();
            $table->string('nombre');
            $table->string('descripcion');
            $table->float("puntaje");
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
        Schema::dropIfExists('desafios');
    }
}
