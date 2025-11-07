<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Partida;
use App\Models\Tablero;
use App\Models\Ficha;
use App\Models\Recinto;

class PartidaController extends Controller
{
    public function crearPartida()
    {
        $user = session('user');
        if (!$user) {
            return redirect()->route('login.form')->with('error', 'Debes iniciar sesión');
        }
        
     
        $partida = Partida::create([
            'email' => $user->email,
            'puntajetotal' => 0
        ]);
        
    
        Tablero::create([
            'partida_id' => $partida->idpartida,
            'estado' => json_encode([
                'recinto1' => [], 'recinto2' => [], 'recinto3' => [], 
                'recinto4' => [], 'recinto5' => [], 'recinto6' => [], 'recinto7' => []
            ])
        ]);
        
        $id = $partida->idpartida;
        return redirect()->route('tablero', ['id' => $id]);
    }

   public function mostrarTablero($id)
{
    $partida = Partida::find($id);
    if (!$partida) {
        return redirect()->route('gestionar-partidas')->with('error', 'Partida no encontrada');
    }

    // Obtener estado del tablero
    $tablero = Tablero::where('partida_id', $id)->first();
    
    $estado = $tablero && $tablero->estado ? json_decode($tablero->estado, true) : [
        'recinto1' => [], 'recinto2' => [], 'recinto3' => [], 
        'recinto4' => [], 'recinto5' => [], 'recinto6' => [], 'recinto7' => []
    ];

    // Obtener datos maestros para el frontend
    $fichas = Ficha::all()->keyBy('tipo_ficha');
    $recintos = Recinto::all()->keyBy('nombre_recinto');

    return view('tablero', [
        'id' => $id,
        'estado' => $estado,
        'fichas' => $fichas,
        'recintos' => $recintos
    ]);
}

    public function guardarPartida(Request $request)
{
    $request->validate([
        'idpartida' => 'required|exists:partida,idpartida',
        'puntajetotal' => 'required|integer',
        'estado_tablero' => 'required|array'
    ]);

    $partida = Partida::find($request->idpartida);
    if ($partida) {
        // Actualizar puntaje total
        $partida->puntajetotal = $request->puntajetotal;
        $partida->save();
        
        // Actualizar estado del tablero CON FORMATO LEGIBLE
        $tablero = Tablero::where('partida_id', $request->idpartida)->first();
        if ($tablero) {
            $tablero->estado = json_encode($request->estado_tablero, JSON_PRETTY_PRINT);
            $tablero->save();
        }
        
        return response()->json([
            'success' => true, 
            'message' => 'Partida guardada exitosamente',
            'puntaje' => $request->puntajetotal
        ]);
    }
    
    return response()->json([
        'success' => false, 
        'message' => 'Partida no encontrada'
    ], 404);
}

    public function gestionarPartidas()
    {
        $user = session('user');
        if (!$user) {
            return redirect()->route('login.form')->with('error', 'Debes iniciar sesión');
        }
        
        $partidas = Partida::where('email', $user->email)->get();
        return view('gestionar-partidas', compact('partidas'));
    }

    public function borrarPartida($id)
    {
        $user = session('user');
        if (!$user) {
            return redirect()->route('login.form')->with('error', 'Debes iniciar sesión');
        }
        
        $partida = Partida::where('idpartida', $id)->where('email', $user->email)->first();
        if ($partida) {
          
            $partida->delete();
            return redirect()->route('gestionar-partidas')->with('success', 'Partida borrada correctamente');
        }
        
        return redirect()->route('gestionar-partidas')->with('error', 'Partida no encontrada o no tienes permisos');
    }
}