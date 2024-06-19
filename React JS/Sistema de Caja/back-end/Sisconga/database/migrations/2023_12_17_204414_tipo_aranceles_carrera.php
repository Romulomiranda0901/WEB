<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TipoArancelesCarrera extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('general.tipo_aranceles_carrera', function (Blueprint $table) {
            $table->id();
            $table->integer('id_tipopago');
            $table->foreign("id_tipopago")
                ->references("id")
                ->on("general.tipopago");
            $table->integer('id_carrera_se');
            $table->foreign("id_carrera_se")
                ->references("id")
                ->on("general.carrera_sede");
            $table->integer('id_truno');
            $table->foreign("id_truno")
                ->references("id")
                ->on("general.turno");
            $table->decimal('monto','2');
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
        Schema::dropIfExists('general.tipopago');
    }

}
