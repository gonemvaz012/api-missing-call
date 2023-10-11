<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateColasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('colas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('id_cola')->nullable();
            $table->string('cola')->nullable();
            $table->string('clid')->nullable();
            $table->string('prefijo')->nullable();

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
        Schema::dropIfExists('colas');
    }
}
