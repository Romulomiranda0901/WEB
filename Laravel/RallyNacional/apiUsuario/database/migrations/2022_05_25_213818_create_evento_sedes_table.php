<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventoSedesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('evento_sedes', function (Blueprint $table) {
            $table->id();
            $table->foreignId("sede_id")->constrained();
            $table->foreignId("evento_id")->constrained();
            $table->foreignId("coordinador_id")->constrained("coordinador_sedes");
            $table->integer('max_participacion');
            $table->integer("anyo")->default(date("Y"));
            $table->softDeletes();
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
        Schema::dropIfExists('evento_sedes');
    }
}
