<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Partida extends Model
{
    use HasFactory;

    protected $table = 'partida';
    protected $primaryKey = 'idpartida';

    protected $fillable = [
        'email',
        'puntajetotal'
    ];

    public function tablero()
    {
        return $this->hasOne(Tablero::class, 'partida_id', 'idpartida');
    }
}