<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistorialLLamadasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('historial_l_lamadas', function (Blueprint $table) {
            $table->id();
            $table->string('id_gestion')->nullable();
            $table->string('id_llamada')->nullable();
            $table->string('id_usuario')->nullable();
            $table->string('devolucion_n_efectiva')->nullable();
            $table->string('fecha')->nullable();
            $table->string('hora')->nullable();
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
        Schema::dropIfExists('historial_l_lamadas');
    }
}
