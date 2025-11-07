@extends('template')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card shadow-lg">
                    <div class="card-header bg-info text-white text-center">
                        <h3>Gestionar Mis Partidas</h3>
                    </div>
                    <div class="card-body">
                        {{-- Mensajes --}}
                        @if(session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif
                        @if(session('error'))
                            <div class="alert alert-danger">{{ session('error') }}</div>
                        @endif

                        <a href="{{ route('crear-partida') }}" class="btn btn-primary mb-3">Crear Nueva Partida</a>

                        <h4>Mis Partidas:</h4>
                        @if($partidas->isEmpty())
                            <p>No tienes partidas creadas aún.</p>
                        @else
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>ID Partida</th>
                                        <th>Puntaje Total</th>
                                        <th>Fecha de Creación</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($partidas as $partida)
                                        <tr>
                                            <td>{{ $partida->idpartida }}</td>
                                            <td>{{ $partida->puntajetotal }}</td>
                                            <td>{{ $partida->created_at->format('d/m/Y H:i') }}</td>
                                            <td>
                                                <a href="{{ route('tablero', ['id' => $partida->idpartida]) }}" class="btn btn-sm btn-success">Jugar</a>
                                                <form action="{{ route('borrar-partida', $partida->idpartida) }}" method="POST" style="display: inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Seguro que quieres borrar esta partida?')">Borrar</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endif

                        <a href="{{ route('home') }}" class="btn btn-secondary">Volver a Home</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection