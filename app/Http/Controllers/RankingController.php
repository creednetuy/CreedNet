<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Partida;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class RankingController extends Controller
{
    public function mostrarRanking()
    {
        $ranking = Partida::where('puntajetotal', '>', 0)
            ->join('users', 'partida.email', '=', 'users.email')
            ->select('partida.*', 'users.name as player_name')
            ->orderBy('puntajetotal', 'DESC')
            ->limit(10) 
            ->get();

        return view('ranking', compact('ranking'));
    }
}