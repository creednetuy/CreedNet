@extends('template')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-10">
            <div class="card shadow-lg">
                <div class="card-header bg-warning text-dark text-center">
                    <h2 class="mb-0">🏆 Ranking Global - Draftosaurus</h2>
                    <p class="mb-0">Todos los puntajes de los jugadores</p>
                </div>
                <div class="card-body">

                    @if($ranking->isEmpty())
                        <div class="alert alert-info text-center">
                            <h4>¡Aún no hay puntajes!</h4>
                            <p>Se el primero en jugar y aparecer en el ranking.</p>
                            <a href="{{ route('crear-partida') }}" class="btn btn-primary">Jugar Ahora</a>
                        </div>
                    @else
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="table-dark">
                                    <tr>
                                        <th width="80">Posición</th>
                                        <th>Jugador</th>
                                        <th width="120">Puntaje</th>
                                        <th width="150">Fecha</th>
                                        <th width="100">Medalla</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($ranking as $index => $score)
                                    <tr class="{{ $index < 3 ? 'table-success' : '' }}">
                                        <td class="text-center fw-bold">
                                            @if($index == 0)
                                                <span class="text-warning">🥇 1ro</span>
                                            @elseif($index == 1)
                                                <span class="text-secondary">🥈 2do</span>
                                            @elseif($index == 2)
                                                <span class="text-bronze">🥉 3ro</span>
                                            @else
                                                #{{ $index + 1 }}
                                            @endif
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="avatar bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-3" 
                                                     style="width: 40px; height: 40px; font-size: 14px;">
                                                    {{ strtoupper(substr($score->player_name, 0, 2)) }}
                                                </div>
                                                <div>
                                                    <strong>{{ $score->player_name }}</strong>
                                                    <br>
                                                    <small class="text-muted">{{ $score->email }}</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <span class="badge bg-primary fs-6">{{ $score->puntajetotal }} pts</span>
                                        </td>
                                        <td class="text-muted">
                                            {{ \Carbon\Carbon::parse($score->created_at)->format('d/m/Y H:i') }}
                                        </td>
                                        <td class="text-center">
                                            @if($index == 0)
                                                <span class="fs-4">🥇</span>
                                            @elseif($index == 1)
                                                <span class="fs-4">🥈</span>
                                            @elseif($index == 2)
                                                <span class="fs-4">🥉</span>
                                            @elseif($score->puntajetotal >= 50)
                                                <span class="text-success">⭐</span>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Statistics -->
                        <div class="row mt-4 text-center">
                            <div class="col-md-4">
                                <div class="card bg-light">
                                    <div class="card-body">
                                        <h5 class="text-primary">Mejor Puntaje</h5>
                                        <h3 class="text-success">{{ $ranking->max('puntajetotal') }} pts</h3>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card bg-light">
                                    <div class="card-body">
                                        <h5 class="text-primary">Puntaje Promedio</h5>
                                        <h3 class="text-info">{{ round($ranking->avg('puntajetotal'), 1) }} pts</h3>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card bg-light">
                                    <div class="card-body">
                                        <h5 class="text-primary">Total de Partidas</h5>
                                        <h3 class="text-warning">{{ $ranking->count() }}</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- Call to Action -->
                    <div class="text-center mt-4">
                        <p>¿Quieres aparecer en el ranking?</p>
                        <a href="{{ route('crear-partida') }}" class="btn btn-success btn-lg">Jugar Partida</a>
                        <a href="{{ route('home') }}" class="btn btn-outline-secondary">Volver al Inicio</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div
@endsection