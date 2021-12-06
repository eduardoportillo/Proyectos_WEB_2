<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePartidasTable extends Migration
{
    public function up()
    {
        Schema::create('partidas', function (Blueprint $table) {
            $table->id();
            $table->dateTime('fecha');
            $table->unsignedBigInteger('id_equipo_1');
            $table->unsignedBigInteger('id_equipo_2');
            $table->integer('nro_ronda');
            $table->integer('resultado');
            $table->timestamps();

            $table->foreign('id_equipo_1')
                ->references('id')
                ->on('equipos')
                ->onDelete('cascade');

            $table->foreign('id_equipo_2')
                ->references('id')
                ->on('equipos')
                ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('partidas');
    }
}
