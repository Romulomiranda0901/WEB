<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEvaluacionPorSedesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('evaluacion_por_sedes', function (Blueprint $table) {
            $table->id();
            $table->foreignId("entregables_id")->constrained("entregables");
            $table->float("nota_documento");
            $table->float("nota_video");
            $table->float("nota_final");
            $table->text("descripcion");
            $table->integer("anyo")->default(date("Y"));
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
        Schema::dropIfExists('evaluacion_por_sedes');
    }
}
