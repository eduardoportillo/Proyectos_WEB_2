<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInscripcionTorneosTable extends Migration
{
    public function up()
    {
        Schema::create('inscripcion_torneos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('torneo_id');

            $table->foreign('user_id')
                ->references('id')
                ->on('users');
                //->onDelete('set null');

            $table->foreign('torneo_id')
                ->references('id')
                ->on('torneos');
                //->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::dropIfExists('inscripcion_torneos');
    }
}
