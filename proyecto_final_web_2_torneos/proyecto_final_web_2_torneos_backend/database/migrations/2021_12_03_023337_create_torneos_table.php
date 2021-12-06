<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTorneosTable extends Migration
{
    public function up()
    {
        Schema::create('torneos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->String('juego_torneo');
            $table->string('modalidad_torneo');
            $table->dateTime('fecha_inicio');
            $table->dateTime('fecha_fin');
            $table->string('estado');
            $table->integer('puntuacion_victoria');
            $table->integer('puntuacion_empate');
            $table->integer('puntuacion_derrota');
            $table->unsignedBigInteger('creador_user_id');
            $table->integer('nro_equipos');
            $table->integer('num_partidos');
            $table->timestamps();

            $table->foreign('creador_user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
        });

    }

    public function down()
    {
        Schema::dropIfExists('torneos');
    }
}
