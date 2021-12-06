<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTorneosTable extends Migration
{
    public function up()
    {
        Schema::create('modalidad_torneo', function (Blueprint $table) {
            $table->id();
            $table->string('name_modalidad');
        });

        Schema::create('torneos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->String('juego_torneo');
            $table->unsignedBigInteger('modalidad_torneo_id');
            $table->dateTime('fecha_inicio');
            $table->dateTime('fecha_fin');
            $table->string('estado');
            $table->integer('puntuacion_victoria');
            $table->unsignedBigInteger('creador_user_id');
            $table->timestamps();

            $table->foreign('modalidad_torneo_id')
                ->references('id')
                ->on('modalidad_torneo')
                ->onDelete('cascade');
        });

    }

    public function down()
    {
        Schema::dropIfExists('torneos');
    }
}
