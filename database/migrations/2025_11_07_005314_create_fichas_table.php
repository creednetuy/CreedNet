<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('fichas', function (Blueprint $table) {
            $table->id('idficha');
            $table->string('tipo_ficha')->unique();
            $table->string('nombre_mostrado');
            $table->string('imagen_path'); 
            $table->timestamps();
        });

        // Insertar las 6 fichas base del juego
        DB::table('fichas')->insert([
            [
                'tipo_ficha' => 'Rey', 
                'nombre_mostrado' => 'Rey', 
                'imagen_path' => '/imagenes/ficha1.png'
            ],
            [
                'tipo_ficha' => 'Bigote', 
                'nombre_mostrado' => 'Bigote', 
                'imagen_path' => '/imagenes/ficha2.png'
            ],
            [
                'tipo_ficha' => 'SombreroNegro', 
                'nombre_mostrado' => 'Sombrero Negro', 
                'imagen_path' => '/imagenes/ficha3.png'
            ],
            [
                'tipo_ficha' => 'Huevo', 
                'nombre_mostrado' => 'Huevo', 
                'imagen_path' => '/imagenes/ficha4.png'
            ],
            [
                'tipo_ficha' => 'Patito', 
                'nombre_mostrado' => 'Patito', 
                'imagen_path' => '/imagenes/ficha5.png'
            ],
            [
                'tipo_ficha' => 'SombreroAmarillo', 
                'nombre_mostrado' => 'Sombrero Amarillo', 
                'imagen_path' => '/imagenes/ficha6.png'
            ],
        ]);
    }

    public function down()
    {
        Schema::dropIfExists('fichas');
    }
};