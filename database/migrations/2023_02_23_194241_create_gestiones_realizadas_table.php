<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGestionesRealizadasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gestiones_realizadas', function (Blueprint $table) {
            // $table->id();
            $table->bigIncrements('id_gestion');
            $table->string('fecha')->nullable();
            $table->string('hora')->nullable();
            $table->string('id_usuario')->nullable();
            $table->text('comentarios')->nullable();
            $table->string('devolucion_efectiva')->nullable();
            $table->string('id_llamada_estado')->nullable();
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
        Schema::dropIfExists('gestiones_realizadas');
    }
}
