<?php
// app/Models/Ficha.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ficha extends Model
{
    use HasFactory;

    protected $table = 'fichas';
    protected $primaryKey = 'idficha';

    protected $fillable = [
        'tipo_ficha',
        'nombre_mostrado',
        'imagen_path'
    ];

    // Relación con recintos (a través de tabla pivote que crearemos después)
    public function recintos()
    {
        return $this->belongsToMany(Recinto::class, 'ficha_recinto', 'ficha_id', 'recinto_id')
                    ->withTimestamps();
    }
}