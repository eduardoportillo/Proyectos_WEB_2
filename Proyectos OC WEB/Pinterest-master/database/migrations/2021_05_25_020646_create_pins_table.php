<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePinsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('pins');
        Schema::create('pins', function (Blueprint $table) {
            $table->id();
            $table->string("titulo");
            $table->string("imagen");
            $table->string("url");
            $table->bigInteger("tablero_id")->unsigned();
            $table->bigInteger("usuario_id");
            $table->timestamps();
            $table->foreign('tablero_id')->references('id')->on('tableros')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pins');
    }
}
