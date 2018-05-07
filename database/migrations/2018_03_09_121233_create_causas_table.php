<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCausasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('causas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre')->unique();
            $table->integer('num_exp'); // Combinacion de un numero secuencial y el año de registro
            $table->integer('etapa_id')->unsigned();
            $table->foreign('etapa_id')->references('id')->on('etapas');
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
        Schema::dropIfExists('causas');
    }
}
