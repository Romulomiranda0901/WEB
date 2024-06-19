<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Subsede extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('general.subsedes', function (Blueprint $table) {
            $table->id();
            $table->string('nombre','100');
            $table->integer('id_sede');
            $table->foreign('id_sede') ->references("id")
                ->on("general.sedes")
                ->onDelete("cascade");
            $table->char('activo',2)->default('SI');
            $table->char('eliminado',2)->default('NO');
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
        Schema::dropIfExists('general.subsedes');
    }
}
