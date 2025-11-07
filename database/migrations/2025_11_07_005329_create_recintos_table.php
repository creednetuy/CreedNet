<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('recintos', function (Blueprint $table) {
            $table->id('idrecinto');
            $table->string('nombre_recinto')->unique(); 
            $table->string('nombre_mostrado'); 
            $table->text('reglas'); 
            $table->integer('orden_posicion'); 
            $table->timestamps();
        });

        // Insertar los 7 recintos del tablero
        DB::table('recintos')->insert([
            [
                'nombre_recinto' => 'recinto1', 
                'nombre_mostrado' => 'Santuario Real',
                'reglas' => 'Todas las fichas deben ser del mismo tipo',
                'orden_posicion' => 1
            ],
            [
                'nombre_recinto' => 'recinto2', 
                'nombre_mostrado' => 'Guardería',
                'reglas' => 'Máximo 3 fichas permitidas',
                'orden_posicion' => 2
            ],
            [
                'nombre_recinto' => 'recinto3', 
                'nombre_mostrado' => 'Zona de Parejas', 
                'reglas' => 'Puntos por pares de fichas iguales',
                'orden_posicion' => 3
            ],
            [
                'nombre_recinto' => 'recinto4', 
                'nombre_mostrado' => 'Área de Diversidad',
                'reglas' => 'Todas las fichas deben ser diferentes',
                'orden_posicion' => 4
            ],
            [
                'nombre_recinto' => 'recinto5', 
                'nombre_mostrado' => 'Territorio Competitivo',
                'reglas' => 'Bonus por mayoría confirmada',
                'orden_posicion' => 5
            ],
            [
                'nombre_recinto' => 'recinto6', 
                'nombre_mostrado' => 'Zona Libre',
                'reglas' => '1 punto por cada ficha',
                'orden_posicion' => 6
            ],
            [
                'nombre_recinto' => 'recinto7', 
                'nombre_mostrado' => 'Santuario Exclusivo', 
                'reglas' => 'Solo 1 ficha - bonus si es única en todo el tablero',
                'orden_posicion' => 7
            ],
        ]);
    }

    public function down()
    {
        Schema::dropIfExists('recintos');
    }
};