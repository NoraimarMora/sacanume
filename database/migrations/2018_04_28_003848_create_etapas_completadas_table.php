<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEtapasCompletadasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('etapas_completadas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('causa_id')->unsigned();
            $table->foreign('causa_id')->references('id')->on('causas');
            $table->string('etapas');
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
        Schema::dropIfExists('etapas_completadas');
    }
}
