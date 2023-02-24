<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLlamadasContestadasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('llamadas_contestadas', function (Blueprint $table) {
            // $table->id();
            $table->bigIncrements('id_llamada_contestada');
            $table->string('duracion')->nullable();
            $table->string('agente_atiende')->nullable();
            $table->string('id_llamada')->nullable();
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
        Schema::dropIfExists('llamadas_contestadas');
    }
}
