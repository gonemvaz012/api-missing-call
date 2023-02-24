<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLlamadasRealizadasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('llamadas_realizadas', function (Blueprint $table) {
            // $table->id();
            $table->bigIncrements('id_llamada_realizada');
            $table->string('fecha')->nullable();
            $table->string('hora')->nullable();
            $table->string('id_usuario')->nullable();
            $table->text('comentarios')->nullable();
            $table->string('devolucion_efectiva')->nullable();
            $table->string('id_llamada_estado')->nullable();
            $table->text('api_callid')->nullable();
            $table->text('api_result')->nullable();
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
        Schema::dropIfExists('llamadas_realizadas');
    }
}
