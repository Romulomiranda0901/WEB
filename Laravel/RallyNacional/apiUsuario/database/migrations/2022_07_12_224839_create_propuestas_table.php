<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePropuestasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('propuestas', function (Blueprint $table) {
            $table->id();
            $table->string("nombre");
            $table->foreignId("categoria_id")->constrained();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('desafio_propuestas', function (Blueprint $table) {
            $table->id();
            $table->foreignId("propuesta_id")->constrained();
            $table->foreignId("desafio_id")->constrained();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('desafio_propuestas');
        Schema::dropIfExists('propuestas');
    }
}
