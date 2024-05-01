<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoordinadorSedesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coordinador_sedes', function (Blueprint $table) {
            $table->id();
            $table->foreignId("sede_id")->constrained();
            $table->string('cedula')->unique();
            $table->string('nombres');
            $table->string('apellidos');
            $table->foreignId("genero_id")->constrained();
            $table->foreignId("tipo_cordinadors_id")->constrained();
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
        Schema::dropIfExists('coordinador_sedes');
    }
}
