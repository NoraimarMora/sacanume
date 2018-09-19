<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCausaOperadorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('causa_operador', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('causa_id')->unsigned();
            $table->foreign('causa_id')->references('id')->on('causas');
            $table->integer('operador_id')->unsigned();
            $table->foreign('operador_id')->references('id')->on('operadores');
            $table->enum('cargo', [1, 2, 3, 4, 5, 6, 7, 8, 9]);
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
        Schema::dropIfExists('causas_operadores');
    }
}
