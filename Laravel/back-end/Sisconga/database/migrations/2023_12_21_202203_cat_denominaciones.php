<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CatDenominaciones extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('general.cat_denominaciones', function (Blueprint $table) {
            $table->id();
            $table->integer('id_cat_moneda');
            $table->foreign("id_cat_moneda")
                ->references("id")
                ->on("general.cat_moneda");
            $table->integer('id_tipo_moneda');
            $table->foreign("id_tipo_moneda")
                ->references("id")
                ->on("general.tipo_moneda");
            $table->string('valor_denominaciones','100');
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
        Schema::dropIfExists('general.cat_denominaciones');
    }
}
