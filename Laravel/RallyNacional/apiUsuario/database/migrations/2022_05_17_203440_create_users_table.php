<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->foreignId("evento_id")->nullable()->constrained();
          //  $table->foreignId("rol_id")->constrained("role");
            $table->string('name')->unique();
            $table->string('password');
            $table->integer("anyo")->default(date("Y"));
            $table->string("model_type")->nullable();
            $table->unsignedInteger("model_id")->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
