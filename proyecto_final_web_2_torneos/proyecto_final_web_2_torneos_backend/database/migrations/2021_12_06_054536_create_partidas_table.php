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
            $table->dateTime('fecha')->nullable();
            $table->unsignedBigInteger('id_equipo_1')->nullable();
            $table->unsignedBigInteger('id_equipo_2')->nullable();
            $table->unsignedBigInteger('ganador_partida_1')->nullable();
            $table->unsignedBigInteger('ganador_partida_2')->nullable();
            $table->unsignedBigInteger('torneo_id')->nullable();
            $table->integer('nro_ronda')->nullable();
            $table->integer('resultado')->nullable();
            $table->timestamps();

            $table->foreign('id_equipo_1')
                ->references('id')
                ->on('equipos')
                ->onDelete('cascade');

            $table->foreign('id_equipo_2')
                ->references('id')
                ->on('equipos')
                ->onDelete('cascade');

            $table->foreign('ganador_partida_1')
                ->references('id')
                ->on('partidas')
                ->onDelete('cascade');

            $table->foreign('ganador_partida_2')
                ->references('id')
                ->on('partidas')
                ->onDelete('cascade');

            $table->foreign('torneo_id')
                ->references('id')
                ->on('torneos')
                ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('partidas');
    }
}
