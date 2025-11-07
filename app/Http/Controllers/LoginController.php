<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
class LoginController extends Controller
{
    public function showForm()
    {
        return view('login');
    }
    public function store(Request $request)
    {
        $user = DB::table('users')->where('email', $request->email)->first();
        if (!$user || !Hash::check($request->password, $user->password)) {
            return back()->with('error', 'Correo o contraseña incorrectos');
        }
        session(['user' => $user]);
        return redirect()->route('home')->with('success', 'Sesión iniciada correctamente');
    }
    // Método para logout 
    public function logout(Request $request)
    {
        $request->session()->forget('user');  // Limpiar la sesión manual
        return redirect()->route('login.form')->with('success', 'Sesión cerrada correctamente');
    }
}