@extends('template')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-lg text-center">
                    <div class="card-body">
                        @if(session('user'))
                            <h1 class="text-primary mb-4">¡Bienvenido, {{ session('user')->name }}!</h1>
                            <p class="text-muted mb-4">¿Listo para jugar? Elige una opción:</p>
                            
                            <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                                <a href="{{ route('crear-partida') }}" class="btn btn-primary btn-lg">Crear partida</a>
                                <a href="{{ route('gestionar-partidas') }}" class="btn btn-info btn-lg">Gestionar Partidas</a>
                                <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                                    @csrf
                                    <button type="submit" class="btn btn-outline-secondary btn-lg">Cerrar sesión</button>
                                </form>
                            </div>
                        @else
                            <h1 class="text-warning">Acceso restringido</h1>
                            <p>Por favor, <a href="{{ route('login.form') }}" class="text-decoration-none">inicia sesión</a> para jugar.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection