<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('tablero', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('partida_id');
            $table->json('estado')->nullable();
            $table->timestamps();

            $table->foreign('partida_id')
                  ->references('idpartida')->on('partida')
                  ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('tablero');
    }
};
