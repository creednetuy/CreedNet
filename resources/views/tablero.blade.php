@extends('template')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-10">
            <div class="card shadow">
                <div class="card-header bg-primary text-white text-center">
                    <h2 class="mb-0">Tablero de Arrastrar y Soltar - Partida ID: {{ $id }}</h2>
                </div>
                <div class="card-body">

                    <!-- Fila principal: Tablero y fichas -->
                    <div class="row">
                        <!-- Tablero -->
                        <div class="col-12 col-md-8 mb-4">
                            <div id="tablero"
                             data-partida-id="{{ $id }}"
                              data-estado="{{ json_encode($estado) }}"
                               data-fichas="{{ json_encode($fichas) }}"
                                data-recintos="{{ json_encode($recintos) }}"
                                class="position-relative border rounded p-3 bg-light">
                                <img src="{{ asset('imagenes/tablero.png') }}" alt="Tablero" class="d-block rounded">
                                
                                <!-- Zonas -->
                                <div id="recinto1" class="drop-zone" ondragover="dragOver(event)" ondrop="drop(event)"></div>
                                <div id="recinto2" class="drop-zone" ondragover="dragOver(event)" ondrop="drop(event)"></div>
                                <div id="recinto3" class="drop-zone" ondragover="dragOver(event)" ondrop="drop(event)"></div>
                                <div id="recinto4" class="drop-zone" ondragover="dragOver(event)" ondrop="drop(event)"></div>
                                <div id="recinto5" class="drop-zone" ondragover="dragOver(event)" ondrop="drop(event)"></div>
                                <div id="recinto6" class="drop-zone" ondragover="dragOver(event)" ondrop="drop(event)"></div>
                                <div id="recinto7" class="drop-zone" ondragover="dragOver(event)" ondrop="drop(event)"></div>
                            </div>
                        </div>

                        <!-- Fichas -->
                        <div class="col-12 col-md-4">
                            <h4 class="text-center mb-3">Fichas Disponibles</h4>
                            <div class="d-flex flex-column align-items-center">
                                <div class="mb-3">
                                    <div id="item1" draggable="true" ondragstart="dragStart(event)" class="ficha ficha-Rey" data-type="Rey" title="Rey"></div>
                                    <small class="text-muted">Rey</small>
                                </div>
                                <div class="mb-3">
                                    <div id="item2" draggable="true" ondragstart="dragStart(event)" class="ficha ficha-Bigote" data-type="Bigote" title="Bigote"></div>
                                    <small class="text-muted">Bigote</small>
                                </div>
                                <div class="mb-3">
                                    <div id="item3" draggable="true" ondragstart="dragStart(event)" class="ficha ficha-SombreroNegro" data-type="SombreroNegro" title="Sombrero Negro"></div>
                                    <small class="text-muted">Sombrero Negro</small>
                                </div>
                                <div class="mb-3">
                                    <div id="item4" draggable="true" ondragstart="dragStart(event)" class="ficha ficha-Huevo" data-type="Huevo" title="Huevo"></div>
                                    <small class="text-muted">Huevo</small>
                                </div>
                                <div class="mb-3">
                                    <div id="item5" draggable="true" ondragstart="dragStart(event)" class="ficha ficha-Patito" data-type="Patito" title="Patito"></div>
                                    <small class="text-muted">Patito</small>
                                </div>
                                <div class="mb-3">
                                    <div id="item6" draggable="true" ondragstart="dragStart(event)" class="ficha ficha-SombreroAmarillo" data-type="SombreroAmarillo" title="Sombrero Amarillo"></div>
                                    <small class="text-muted">Sombrero Amarillo</small>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Botones -->
                    <div class="row justify-content-center mt-4">
                        <div class="col-12 text-center">
                            <div class="mt-4 text-center">
                            <p>¿Tienes la mayor cantidad de pingüinos de la especie correspondiente en el tablero?</p>
                            <button id="mayoriaSi" class="btn btn-outline-success me-2">Sí</button>
                            <button id="mayoriaNo" class="btn btn-outline-danger">No</button>
                            </div>
                            <br>
                            
                            <button id="finalizarPartidaBtn" class="btn btn-success btn-lg" data-id="{{ $id }}">
                                Finalizar Partida y Ver Resultados
                            </button>
                            <div id="puntajeTotal" class="mt-3 alert alert-info"></div>

                            <!-- Dado manual -->
                            <div class="mt-4">
                                <h4>Selecciona la cara del dado</h4>
                                <div id="diceButtons" class="d-flex justify-content-center flex-wrap gap-2 mt-2">
                                    <button class="btn dice-btn" data-value="1" style="background-image:url('/imagenes/cara1.png'); background-size:cover; width:75px; height:75px;"></button>
                                    <button class="btn dice-btn" data-value="2" style="background-image:url('/imagenes/cara2.png'); background-size:cover; width:75px; height:75px;"></button>
                                    <button class="btn dice-btn" data-value="3" style="background-image:url('/imagenes/cara3.png'); background-size:cover; width:75px; height:75px;"></button>
                                    <button class="btn dice-btn" data-value="4" style="background-image:url('/imagenes/cara4.png'); background-size:cover; width:75px; height:75px;"></button>
                                    <button class="btn dice-btn" data-value="5" style="background-image:url('/imagenes/cara5.png'); background-size:cover; width:75px; height:75px;"></button>
                                    <button class="btn dice-btn" data-value="6" style="background-image:url('/imagenes/cara6.png'); background-size:cover; width:75px; height:75px;"></button>
                                </div>
                                <div id="diceResult" class="mt-3 fs-4 fw-bold text-primary"></div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

    <script src="{{ asset('js/tablero.js') }}"></script>
@endsection