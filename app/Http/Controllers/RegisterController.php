<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    // Mostrar el formulario
    public function showForm()
    {
        return view('register');
    }

    // Guardar los datos
    public function store(Request $request)
    {
        // Validar los campos del formulario
        $request->validate([
            'name' => 'required|string|min:3|max:12',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
        ]);

        // Crear el usuario
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Redirigir con mensaje de éxito
      return redirect('/register')->with('success', 'Funciono!');

    }
}
