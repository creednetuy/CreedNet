<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PartidaController;
use App\Http\Controllers\RankingController;

// =============================================
// RUTAS DEL JUEGO - DRAFTOSAURUS
// =============================================

// RUTAS DE PARTIDAS
Route::get('/crear-partida', [PartidaController::class, 'crearPartida'])->name('crear-partida');
Route::get('/tablero/{id}', [PartidaController::class, 'mostrarTablero'])->name('tablero');
Route::post('/guardar-partida', [PartidaController::class, 'guardarPartida'])->name('guardar-partida');
Route::get('/gestionar-partidas', [PartidaController::class, 'gestionarPartidas'])->name('gestionar-partidas');
Route::delete('/partida/{id}', [PartidaController::class, 'borrarPartida'])->name('borrar-partida');
Route::post('/guardar-tablero', [PartidaController::class, 'guardarTablero']);

// RUTAS DE AUTENTICACIÓN
Route::get('/register', [RegisterController::class, 'showForm'])->name('register.form');
Route::post('/register', [RegisterController::class, 'store'])->name('register.store');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/login', [LoginController::class, 'showForm'])->name('login.form');
Route::post('/login', [LoginController::class, 'store'])->name('login.store');

// RUTAS DE RANKING
Route::get('/ranking', [RankingController::class, 'mostrarRanking'])->name('ranking');

// RUTAS DE PÁGINAS ESTÁTICAS
Route::get('/', function () {
    return view('index');
});

Route::get('/registro', function () {
    return view('registro');
});

Route::get('/manual', function () {
    return view('manual');
});

Route::get('/home', function () {
    $user = session('user');
    if (!$user) {
        return redirect()->route('login.form')->with('error', 'Debes iniciar sesión primero');
    }
    return view('home', compact('user'));
})->name('home');