<?php
// app/Models/Recinto.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recinto extends Model
{
    use HasFactory;

    protected $table = 'recintos';
    protected $primaryKey = 'idrecinto';

    protected $fillable = [
        'nombre_recinto',
        'nombre_mostrado', 
        'reglas',
        'orden_posicion'
    ];

    // Relación con fichas (a través de tabla pivote que crearemos después)
    public function fichas()
    {
        return $this->belongsToMany(Ficha::class, 'ficha_recinto', 'recinto_id', 'ficha_id')
                    ->withTimestamps();
    }

    // Helper para obtener recinto por nombre
    public static function porNombre($nombreRecinto)
    {
        return static::where('nombre_recinto', $nombreRecinto)->first();
    }
}