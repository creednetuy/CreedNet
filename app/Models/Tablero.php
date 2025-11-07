<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tablero extends Model
{
    use HasFactory;

    protected $table = 'tablero';
    
    protected $fillable = [
        'partida_id',
        'estado'
    ];

    protected $casts = [
        'estado' => 'array'
    ];

    public function partida()
    {
        return $this->belongsTo(Partida::class, 'partida_id', 'idpartida');
    }
}