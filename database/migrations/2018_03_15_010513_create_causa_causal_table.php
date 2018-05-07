<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCausaCausalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('causa_causal', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('causa_id')->unsigned();
            $table->foreign('causa_id')->references('id')->on('causas');
            $table->integer('causal_id')->unsigned();
            $table->foreign('causal_id')->references('id')->on('causales');
            $table->boolean('sentencia')->default(false);
            $table->unique(['causa_id', 'causal_id']);
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
        Schema::dropIfExists('causas_causales');
    }
}
