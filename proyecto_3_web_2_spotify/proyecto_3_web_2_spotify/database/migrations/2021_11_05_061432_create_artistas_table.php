<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArtistasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('generos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_genero',50);
            $table->text('path_imagen_genero');
        });

        Schema::create('artistas', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_artista', 50);
            $table->text('path_foto');
            $table->unsignedBigInteger('genero_id')->nullable();
            $table->foreign('genero_id')
                ->references('id')
                ->on('generos')
                ->onDelete('set null');
        });

        Schema::create('canciones', function (Blueprint $table) {
            $table->id();
            $table->string('nombre',50);
            $table->unsignedBigInteger('artista_id')->nullable();
            $table->foreign('artista_id')
                ->references('id')
                ->on('artistas')
                ->onDelete('set null');
            $table->text('path_audio');
            $table->text('path_imagen_cancion');;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('generos');
        Schema::drop('canciones');
        Schema::drop('artistas');
    }
}
