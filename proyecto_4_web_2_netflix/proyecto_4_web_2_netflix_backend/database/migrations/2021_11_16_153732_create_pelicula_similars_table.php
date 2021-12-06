<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePeliculaSimilarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pelicula_similars', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('pelicula_id')->unsigned();
            $table->foreign('pelicula_id')
                ->references('id')
                ->on('peliculas')
                ->onDelete('cascade');
            $table->bigInteger('similar_id')->unsigned();
            $table->foreign('similar_id')
                ->references('id')
                ->on('peliculas')
                ->onDelete('cascade');
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
        Schema::dropIfExists('pelicula_similars');
    }
}
